<?php
/**
 * Created by ERDConverter
 */
namespace PrivateIT\modules\morphology;

use PrivateIT\modules\morphology\components\StringHelperException;
use yii\base\Module;
use yii\helpers\ArrayHelper;
use yii\helpers\StringHelper;
use yii\helpers\Inflector;
use yii\db\ActiveRecord;
use Yii;
use yii\helpers\VarDumper;

/**
 * Class MorphologyModule
 *
 * @package PrivateIT\modules\morphology
 *
 * @property \PrivateIT\modules\morphology\components\StringHelper $stringHelper
 */
class MorphologyModule extends Module
{
    /**
     * Table prefix for ActiveRecord tables
     * @var string|array|callable
     */
    public $tablePrefix = 'morphology_';

    /**
     * Custom table name for ActiveRecord by className
     * @var array
     */
    public $tableNames = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();

        $this->setComponents([
            'stringHelper' => [
                'class' => 'PrivateIT\modules\morphology\components\StringHelper'
            ]
        ]);
    }

    public function registerTranslations()
    {
        if (!isset(Yii::$app->i18n->translations['morphology/*'])) {
            Yii::$app->i18n->translations['morphology/*'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => __DIR__ . '/messages',
            ];
        }
    }

    /**
     * @return string
     */
    static function id()
    {
        return Inflector::slug(__NAMESPACE__);
    }

    /**
     * @return null|Module|MorphologyModule
     */
    public static function getInstance()
    {
        /** @var static $module */
        if (!Yii::$app->hasModule(static::id())) {
            Yii::$app->setModule(static::id(), [
                'class' => static::className()
            ]);
        }
        return Yii::$app->getModule(static::id());
    }

    /**
     * @param string|ActiveRecord $class
     * @return string
     */
    public static function tableName($class)
    {
        /** @var static $module */
        $module = static::getInstance();

        if (array_key_exists($class::className(), $module->tableNames)) {
            return $module->tableNames[$class::className()];
        }

        if (is_callable($module->tablePrefix)) {
            $tableName = call_user_func($module->tablePrefix, $class);
            if ($tableName) {
                return $tableName;
            }
        }

        $tableName = Inflector::camel2id(StringHelper::basename($class), '_');
        return '{{%' . $module->tablePrefix . $tableName . '}}';
    }

    /**
     * @param string $str
     * @param array $data
     * @return string
     */
    public function transform($str, $data)
    {
        $pattern = '~\{(([^\{\}]*|(?R))*)\}~m';
        if (preg_match_all($pattern, $str, $matches)) {
            $this->stringHelper->source = $str;
            $this->stringHelper->data = $data;

            for ($i = 0; $i < sizeof($matches[0]); $i++) {
                $replacement = $matches[0][$i];
                $expressions = $matches[1][$i];
                $this->stringHelper->pattern = $expressions;

                $inners = [];
                if (preg_match_all($pattern, $expressions, $innersMatches)) {
                    foreach ($innersMatches[0] as $innerMatchKey => $innerMatchVal) {
                        $inners['#inner' . $innerMatchKey . '#'] = $innerMatchVal;
                    }
                }

                // replace inners
                $expressions = strtr($expressions, array_flip($inners));

                $expressions = explode('|', $expressions);
                $value = array_shift($expressions);
                $value = ArrayHelper::getValue($data, $value);

                foreach ($expressions as $expression) {

                    $arguments = explode('::', $expression);
                    $funcName = $arguments[0];
                    $arguments[0] = $value;

                    if (is_string($funcName)) {
                        if (method_exists($this->stringHelper, $funcName)) {
                            $funcName = [$this->stringHelper, $funcName];
                        } elseif (Yii::$app->has('formatter') && method_exists(Yii::$app->formatter, $funcName)) {
                            $funcName = [Yii::$app->formatter, $funcName];
                        }
                    }
                    $value = call_user_func_array($funcName, $arguments);

                }

                // return inners
                $value = strtr($value, $inners);
                $str = strtr($str, [$replacement => $this->transform($value, $data)]);
            }
            $str = trim(preg_replace('~\s+~', ' ', $str));
        }
        return $str;
    }
}
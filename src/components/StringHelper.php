<?php

namespace PrivateIT\modules\morphology\components;

use PrivateIT\modules\morphology\models\Dic;
use PrivateIT\modules\morphology\models\Map;
use yii\base\Component;
use yii\helpers\ArrayHelper;
use yii\log\Logger;

class StringHelper extends Component
{
    const MORPHOLOGY_NOMINATIVE = 'nominative';
    const MORPHOLOGY_GENITIVE = 'genitive';
    const MORPHOLOGY_DATIVE = 'dative';
    const MORPHOLOGY_ACCUSATIVE = 'accusative';
    const MORPHOLOGY_INSTRUMENTAL = 'instrumental';
    const MORPHOLOGY_PREPOSITIONAL = 'prepositional';
    const MORPHOLOGY_PLURAL_NOMINATIVE = 'plural_nominative';
    const MORPHOLOGY_PLURAL_GENITIVE = 'plural_genitive';
    const MORPHOLOGY_PLURAL_DATIVE = 'plural_dative';
    const MORPHOLOGY_PLURAL_ACCUSATIVE = 'plural_accusative';
    const MORPHOLOGY_PLURAL_INSTRUMENTAL = 'plural_instrumental';
    const MORPHOLOGY_PLURAL_PREPOSITIONAL = 'plural_prepositional';

    /**
     * @var string
     */
    public $source;
    /**
     * @var string
     */
    public $pattern;
    /**
     * @var array
     */
    public $data = [];

    /**
     * Таблица транслитерации ГОСТ 7.79-2000
     *
     * @var array
     */
    public static $map = [
        'а' => 'a', 'б' => 'b', 'в' => 'v',
        'г' => 'g', 'д' => 'd', 'е' => 'e',
        'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
        'и' => 'i', 'й' => 'j', 'к' => 'k',
        'л' => 'l', 'м' => 'm', 'н' => 'n',
        'о' => 'o', 'п' => 'p', 'р' => 'r',
        'с' => 's', 'т' => 't', 'у' => 'u',
        'ф' => 'f', 'х' => 'kh', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shh',
        'ь' => '', 'ы' => 'y', 'ъ' => '',
        'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
        'А' => 'A', 'Б' => 'B', 'В' => 'V',
        'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
        'Ё' => 'E', 'Ж' => 'ZH', 'З' => 'Z',
        'И' => 'I', 'Й' => 'J', 'К' => 'K',
        'Л' => 'L', 'М' => 'M', 'Н' => 'N',
        'О' => 'O', 'П' => 'P', 'Р' => 'R',
        'С' => 'S', 'Т' => 'T', 'У' => 'U',
        'Ф' => 'F', 'Х' => 'KH', 'Ц' => 'C',
        'Ч' => 'CH', 'Ш' => 'SH', 'Щ' => 'SHH',
        'Ь' => '', 'Ы' => 'Y', 'Ъ' => '',
        'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA',
    ];

    /**
     * Кодировка исходного текста
     * @var string
     */
    public static $charset = 'UTF-8';

    /**
     * @param $word
     * @param $type
     * @return mixed
     * @throws StringHelperException
     */
    public function morphology($word, $type, $exception = true)
    {
        $word = $this->ucfirst($word);
        $words = Dic::find()->andWhere([static::MORPHOLOGY_NOMINATIVE => $word])->asArray()->one();
        if ($words) {
            $result = ArrayHelper::getValue($words, $type);
            if ($result) {
                return $result;
            }
        }
        if ($exception) {
            throw new StringHelperException(__CLASS__ . ':morphology: Word "' . $word . '" not found in ' . Dic::tableName() . ' for type "' . $type . '". Pattern: "' . $this->pattern . '"', Logger::LEVEL_ERROR);
        }
    }

    /**
     * @param $word
     * @param $type
     * @param boolean $exception
     * @return mixed
     * @throws StringHelperException
     */
    public function map($word, $type, $exception = true)
    {
        $word = $this->ucfirst($word);
        $result = Map::find()->andWhere(['value' => $word, 'type' => $type])->select('result')->scalar();
        if ($result) {
            return $result;
        }
        if ($exception) {
            throw new StringHelperException(__CLASS__ . ':map: Word "' . $word . '" not found in ' . Map::tableName() . ' for type "' . $type . '"', Logger::LEVEL_ERROR);
        }
    }

    /**
     * @param string $str
     * @param string $that
     * @return mixed|string
     */
    public function transliteration($str, $that = '-')
    {
        $text = html_entity_decode($str);
        $text = strip_tags($text);
        $text = mb_strtolower($text, static::$charset);
        $text = strtr($text, static::$map);
        $text = strtr($text, ['–' => '-']); // хитрое тире
        $text = strtr($text, ['\'' => '']);
        $text = strtr($text, ['«' => '']);
        $text = strtr($text, ['»' => '']);
        $text = strtr($text, ['&' => 'and']);
        $text = preg_replace('/[^сca-z0-9а-яА-ЯёЁсС!]+/i', ' ', strip_tags($text));
        $text = preg_replace("/([\x80\x93\xe2])|([\x96])/", "-", $text);
        $text = strtr($text, '  ', ' ');
        $text = strtr(trim($text), ' ', $that);
        return $text;
    }

    /**
     * @param string $str
     * @return string
     */
    public function ucfirst($str)
    {
        return mb_strtoupper(mb_substr($str, 0, 1, static::$charset), static::$charset) .
        mb_substr($str, 1, mb_strlen($str, static::$charset), static::$charset);
    }

    /**
     * @param string $str
     * @return string
     */
    public function strtolower($str)
    {
        return mb_strtolower($str, static::$charset);
    }

    /**
     * @param string $str
     * @return string
     */
    public function strtoupper($str)
    {
        return mb_strtoupper($str, static::$charset);
    }

    /**
     * @param string $str
     * @param string $valueYes
     * @param string $valueNo
     * @return string
     */
    public function ifEmpty($str, $valueYes, $valueNo)
    {
        $value = empty($str) ? $valueYes : $valueNo;
        if (preg_match_all('~\@(\S+)~', $value, $matches)) {
            for ($i = 0; $i < sizeof($matches[0]); $i++) {
                $value = strtr(
                    $value,
                    [
                        $matches[0][$i] => ArrayHelper::getValue($this->data, $matches[1][$i])
                    ]
                );
            }
        }
        return $value;
    }

    /**
     * @param $str
     * @throws StringHelperException
     */
    public function notEmpty($str)
    {
        if (!strlen($str)) {
            throw new StringHelperException('Result of expression "' . $this->pattern . '" is empty! String: "' . $this->source . '"');
        }
        return $str;
    }

    /**
     * @param string $str
     * @return string
     */
    public function htmlStrong($str)
    {
        return '<strong>' . $str . '</strong>';
    }

    /**
     * @param string $value
     * @param string $path
     * @param null $defaultValue
     * @return mixed
     */
    public function arrayKey($value, $path, $defaultValue = null)
    {
        $items = ArrayHelper::getValue($this->data, $path, []);
        return ArrayHelper::getValue($items, $value, $defaultValue);
    }
}

class StringHelperException extends \Exception
{

}
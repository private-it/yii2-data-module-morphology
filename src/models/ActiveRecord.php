<?php
/**
 * Created by ERDConverter
 */
namespace PrivateIT\modules\morphology\models;

use yii\helpers\StringHelper;
use Yii;

/**
 * ActiveRecord
 *
 */
class ActiveRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function instantiate($row)
    {
        return Yii::createObject(static::className());
    }

    /**
     * Find related class
     *
     * @param string $class
     * @param string  $defaultNs
     * @return string
     */
    static function findClass($class, $defaultNs)
    {
        $ns = StringHelper::dirname(ltrim(get_called_class(), '\\'));
        if (!class_exists($ns . $class)) {
            $ns = $defaultNs;
            if (!class_exists($defaultNs . $class)) {
                $ns = __NAMESPACE__;
                if (!class_exists($defaultNs . $class)) {
                    $ns = '';
                }
            }
        }
        return $ns . $class;
    }
}
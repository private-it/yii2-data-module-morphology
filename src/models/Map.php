<?php
/**
 * Created by ERDConverter
 */
namespace PrivateIT\modules\morphology\models;

use PrivateIT\modules\morphology\MorphologyModule;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * Map
 *
 * @property integer $id
 * @property string $value
 * @property string $type
 * @property string $result
 *
 */
class Map extends ActiveRecord
{
    const STATUS_ARCHIVED = -1;
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    /**
     * Get object statuses
     *
     * @return array
     */
    static function getStatuses()
    {
        return [
            static::STATUS_ARCHIVED => Yii::t('morphology/map', 'const.status.archived'),
            static::STATUS_DELETED => Yii::t('morphology/map', 'const.status.deleted'),
            static::STATUS_ACTIVE => Yii::t('morphology/map', 'const.status.active'),
        ];
    }

    /**
     * @inheritdoc
     * @return query\MapActiveQuery the newly created [[ActiveQuery]] instance.
     */
    public static function find()
    {
        return parent::find();
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return MorphologyModule::tableName(__CLASS__);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('morphology/map', 'label.id'),
            'value' => Yii::t('morphology/map', 'label.value'),
            'type' => Yii::t('morphology/map', 'label.type'),
            'result' => Yii::t('morphology/map', 'label.result'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'id' => Yii::t('morphology/map', 'hint.id'),
            'value' => Yii::t('morphology/map', 'hint.value'),
            'type' => Yii::t('morphology/map', 'hint.type'),
            'result' => Yii::t('morphology/map', 'hint.result'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributePlaceholders()
    {
        return [
            'id' => Yii::t('morphology/map', 'placeholder.id'),
            'value' => Yii::t('morphology/map', 'placeholder.value'),
            'type' => Yii::t('morphology/map', 'placeholder.type'),
            'result' => Yii::t('morphology/map', 'placeholder.result'),
        ];
    }

    /**
     * Get value from Id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set value to Id
     *
     * @param $value
     * @return $this
     */
    public function setId($value)
    {
        $this->id = $value;
        return $this;
    }

    /**
     * Get value from Value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set value to Value
     *
     * @param $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Get value from Type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set value to Type
     *
     * @param $value
     * @return $this
     */
    public function setType($value)
    {
        $this->type = $value;
        return $this;
    }

    /**
     * Get value from Result
     *
     * @return string
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set value to Result
     *
     * @param $value
     * @return $this
     */
    public function setResult($value)
    {
        $this->result = $value;
        return $this;
    }

}

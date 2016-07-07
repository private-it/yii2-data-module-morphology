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
 * Dic
 *
 * @property integer $id
 * @property string $nominative
 * @property string $genitive
 * @property string $dative
 * @property string $accusative
 * @property string $instrumental
 * @property string $prepositional
 * @property string $plural_nominative
 * @property string $plural_genitive
 * @property string $plural_dative
 * @property string $plural_accusative
 * @property string $plural_instrumental
 * @property string $plural_prepositional
 *
 */
class Dic extends ActiveRecord
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
            static::STATUS_ARCHIVED => Yii::t('morphology/dic', 'const.status.archived'),
            static::STATUS_DELETED => Yii::t('morphology/dic', 'const.status.deleted'),
            static::STATUS_ACTIVE => Yii::t('morphology/dic', 'const.status.active'),
        ];
    }

    /**
     * @inheritdoc
     * @return query\DicActiveQuery the newly created [[ActiveQuery]] instance.
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
            'id' => Yii::t('morphology/dic', 'label.id'),
            'nominative' => Yii::t('morphology/dic', 'label.nominative'),
            'genitive' => Yii::t('morphology/dic', 'label.genitive'),
            'dative' => Yii::t('morphology/dic', 'label.dative'),
            'accusative' => Yii::t('morphology/dic', 'label.accusative'),
            'instrumental' => Yii::t('morphology/dic', 'label.instrumental'),
            'prepositional' => Yii::t('morphology/dic', 'label.prepositional'),
            'plural_nominative' => Yii::t('morphology/dic', 'label.plural_nominative'),
            'plural_genitive' => Yii::t('morphology/dic', 'label.plural_genitive'),
            'plural_dative' => Yii::t('morphology/dic', 'label.plural_dative'),
            'plural_accusative' => Yii::t('morphology/dic', 'label.plural_accusative'),
            'plural_instrumental' => Yii::t('morphology/dic', 'label.plural_instrumental'),
            'plural_prepositional' => Yii::t('morphology/dic', 'label.plural_prepositional'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'id' => Yii::t('morphology/dic', 'hint.id'),
            'nominative' => Yii::t('morphology/dic', 'hint.nominative'),
            'genitive' => Yii::t('morphology/dic', 'hint.genitive'),
            'dative' => Yii::t('morphology/dic', 'hint.dative'),
            'accusative' => Yii::t('morphology/dic', 'hint.accusative'),
            'instrumental' => Yii::t('morphology/dic', 'hint.instrumental'),
            'prepositional' => Yii::t('morphology/dic', 'hint.prepositional'),
            'plural_nominative' => Yii::t('morphology/dic', 'hint.plural_nominative'),
            'plural_genitive' => Yii::t('morphology/dic', 'hint.plural_genitive'),
            'plural_dative' => Yii::t('morphology/dic', 'hint.plural_dative'),
            'plural_accusative' => Yii::t('morphology/dic', 'hint.plural_accusative'),
            'plural_instrumental' => Yii::t('morphology/dic', 'hint.plural_instrumental'),
            'plural_prepositional' => Yii::t('morphology/dic', 'hint.plural_prepositional'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributePlaceholders()
    {
        return [
            'id' => Yii::t('morphology/dic', 'placeholder.id'),
            'nominative' => Yii::t('morphology/dic', 'placeholder.nominative'),
            'genitive' => Yii::t('morphology/dic', 'placeholder.genitive'),
            'dative' => Yii::t('morphology/dic', 'placeholder.dative'),
            'accusative' => Yii::t('morphology/dic', 'placeholder.accusative'),
            'instrumental' => Yii::t('morphology/dic', 'placeholder.instrumental'),
            'prepositional' => Yii::t('morphology/dic', 'placeholder.prepositional'),
            'plural_nominative' => Yii::t('morphology/dic', 'placeholder.plural_nominative'),
            'plural_genitive' => Yii::t('morphology/dic', 'placeholder.plural_genitive'),
            'plural_dative' => Yii::t('morphology/dic', 'placeholder.plural_dative'),
            'plural_accusative' => Yii::t('morphology/dic', 'placeholder.plural_accusative'),
            'plural_instrumental' => Yii::t('morphology/dic', 'placeholder.plural_instrumental'),
            'plural_prepositional' => Yii::t('morphology/dic', 'placeholder.plural_prepositional'),
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
     * Get value from Nominative
     *
     * @return string
     */
    public function getNominative()
    {
        return $this->nominative;
    }

    /**
     * Set value to Nominative
     *
     * @param $value
     * @return $this
     */
    public function setNominative($value)
    {
        $this->nominative = $value;
        return $this;
    }

    /**
     * Get value from Genitive
     *
     * @return string
     */
    public function getGenitive()
    {
        return $this->genitive;
    }

    /**
     * Set value to Genitive
     *
     * @param $value
     * @return $this
     */
    public function setGenitive($value)
    {
        $this->genitive = $value;
        return $this;
    }

    /**
     * Get value from Dative
     *
     * @return string
     */
    public function getDative()
    {
        return $this->dative;
    }

    /**
     * Set value to Dative
     *
     * @param $value
     * @return $this
     */
    public function setDative($value)
    {
        $this->dative = $value;
        return $this;
    }

    /**
     * Get value from Accusative
     *
     * @return string
     */
    public function getAccusative()
    {
        return $this->accusative;
    }

    /**
     * Set value to Accusative
     *
     * @param $value
     * @return $this
     */
    public function setAccusative($value)
    {
        $this->accusative = $value;
        return $this;
    }

    /**
     * Get value from Instrumental
     *
     * @return string
     */
    public function getInstrumental()
    {
        return $this->instrumental;
    }

    /**
     * Set value to Instrumental
     *
     * @param $value
     * @return $this
     */
    public function setInstrumental($value)
    {
        $this->instrumental = $value;
        return $this;
    }

    /**
     * Get value from Prepositional
     *
     * @return string
     */
    public function getPrepositional()
    {
        return $this->prepositional;
    }

    /**
     * Set value to Prepositional
     *
     * @param $value
     * @return $this
     */
    public function setPrepositional($value)
    {
        $this->prepositional = $value;
        return $this;
    }

    /**
     * Get value from PluralNominative
     *
     * @return string
     */
    public function getPluralNominative()
    {
        return $this->plural_nominative;
    }

    /**
     * Set value to PluralNominative
     *
     * @param $value
     * @return $this
     */
    public function setPluralNominative($value)
    {
        $this->plural_nominative = $value;
        return $this;
    }

    /**
     * Get value from PluralGenitive
     *
     * @return string
     */
    public function getPluralGenitive()
    {
        return $this->plural_genitive;
    }

    /**
     * Set value to PluralGenitive
     *
     * @param $value
     * @return $this
     */
    public function setPluralGenitive($value)
    {
        $this->plural_genitive = $value;
        return $this;
    }

    /**
     * Get value from PluralDative
     *
     * @return string
     */
    public function getPluralDative()
    {
        return $this->plural_dative;
    }

    /**
     * Set value to PluralDative
     *
     * @param $value
     * @return $this
     */
    public function setPluralDative($value)
    {
        $this->plural_dative = $value;
        return $this;
    }

    /**
     * Get value from PluralAccusative
     *
     * @return string
     */
    public function getPluralAccusative()
    {
        return $this->plural_accusative;
    }

    /**
     * Set value to PluralAccusative
     *
     * @param $value
     * @return $this
     */
    public function setPluralAccusative($value)
    {
        $this->plural_accusative = $value;
        return $this;
    }

    /**
     * Get value from PluralInstrumental
     *
     * @return string
     */
    public function getPluralInstrumental()
    {
        return $this->plural_instrumental;
    }

    /**
     * Set value to PluralInstrumental
     *
     * @param $value
     * @return $this
     */
    public function setPluralInstrumental($value)
    {
        $this->plural_instrumental = $value;
        return $this;
    }

    /**
     * Get value from PluralPrepositional
     *
     * @return string
     */
    public function getPluralPrepositional()
    {
        return $this->plural_prepositional;
    }

    /**
     * Set value to PluralPrepositional
     *
     * @param $value
     * @return $this
     */
    public function setPluralPrepositional($value)
    {
        $this->plural_prepositional = $value;
        return $this;
    }

}

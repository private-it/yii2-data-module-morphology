<?php

namespace PrivateIT\modules\morphology\components;

use PrivateIT\modules\morphology\models\Dic;
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

    public function morphology($word, $type)
    {
        $word = $this->ucfirst($word);
        $words = Dic::find()->andWhere([static::MORPHOLOGY_NOMINATIVE => $word])->asArray()->one();
        if ($words) {
            return ArrayHelper::getValue($words, $type);
        }
        \Yii::getLogger()->log(__CLASS__ . ': Word "' . $word . '" not found in ' . Dic::tableName(), Logger::LEVEL_ERROR);
        return false;
    }

    public function ucfirst($str)
    {
        return mb_strtoupper(mb_substr($str, 0, 1, 'UTF-8'), 'UTF-8') .
        mb_substr($str, 1, mb_strlen($str, 'UTF-8'), 'UTF-8');
    }

    public function strtolower($str)
    {
        return mb_strtolower($str, 'UTF-8');
    }

    public function strtoupper($str)
    {
        return mb_strtoupper($str, 'UTF-8');
    }

    public function htmlStrong($str)
    {
        return '<strong>' . $str . '</strong>';
    }
}
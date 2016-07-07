<?php
/**
 * Created by ERDConverter
 */
namespace PrivateIT\modules\morphology\models\query;

use PrivateIT\modules\morphology\models\Dic;

/**
 * DicActiveQuery
 *
 */
class DicActiveQuery extends ActiveQuery
{
    /**
     * @inheritdoc
     * @return Dic[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Dic|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /*
    public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }
    */
}

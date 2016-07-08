<?php
/**
 * Created by ERDConverter
 */
namespace PrivateIT\modules\morphology\models\query;

use PrivateIT\modules\morphology\models\Map;

/**
 * MapActiveQuery
 *
 */
class MapActiveQuery extends ActiveQuery
{
    /**
     * @inheritdoc
     * @return Map[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Map|array|null
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

<?php
/**
 * Created by ERDConverter
 */

use yii\db\Schema;
use yii\db\Migration;

/**
 * m160708_081949_001_create_map
 *
 */
class m160708_081949_001_create_map extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(\PrivateIT\modules\morphology\models\Map::tableName(), [
            'id' => $this->primaryKey(),
            'value' => $this->string()->defaultValue(""),
            'relation' => $this->string()->defaultValue(""),
            'result' => $this->string()->defaultValue(""),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable(\PrivateIT\modules\morphology\models\Map::tableName());
    }
}
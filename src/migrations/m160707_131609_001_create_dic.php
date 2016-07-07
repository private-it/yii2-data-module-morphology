<?php
/**
 * Created by ERDConverter
 */

use yii\db\Schema;
use yii\db\Migration;

/**
 * m160707_131609_001_create_dic
 *
 */
class m160707_131609_001_create_dic extends Migration
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

        $this->createTable(\PrivateIT\modules\morphology\models\Dic::tableName(), [
            'id' => $this->primaryKey(),
            'nominative' => $this->string()->defaultValue(""),
            'genitive' => $this->string()->defaultValue(""),
            'dative' => $this->string()->defaultValue(""),
            'accusative' => $this->string()->defaultValue(""),
            'instrumental' => $this->string()->defaultValue(""),
            'prepositional' => $this->string()->defaultValue(""),
            'plural_nominative' => $this->string()->defaultValue(""),
            'plural_genitive' => $this->string()->defaultValue(""),
            'plural_dative' => $this->string()->defaultValue(""),
            'plural_accusative' => $this->string()->defaultValue(""),
            'plural_instrumental' => $this->string()->defaultValue(""),
            'plural_prepositional' => $this->string()->defaultValue(""),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable(\PrivateIT\modules\morphology\models\Dic::tableName());
    }
}
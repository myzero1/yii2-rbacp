<?php

use yii\db\Schema;

class m171129_120101_rbacp_policy extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('rbacp_policy', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(255) NOT NULL',
            'description' => Schema::TYPE_STRING . '(500)',
            'rules' => Schema::TYPE_STRING . '(1000) NOT NULL',
            'scope' => Schema::TYPE_SMALLINT . '(1) NOT NULL DEFAULT 1',
            'sku' => Schema::TYPE_STRING . '(255) NOT NULL',
            'type' => Schema::TYPE_SMALLINT . '(1) NOT NULL',
            'privilege_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'status' => Schema::TYPE_SMALLINT . '(1) NOT NULL DEFAULT 1',
            'created' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'updated' => Schema::TYPE_INTEGER . '(11) NOT NULL',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('rbacp_policy');
    }
}

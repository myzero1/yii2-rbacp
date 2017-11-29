<?php

use yii\db\Schema;

class m171129_120101_rbacp_role extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('rbacp_role', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(255) NOT NULL',
            'description' => Schema::TYPE_STRING . '(500)',
            'policy_ids' => Schema::TYPE_STRING . '(1000)',
            'privilege_ids' => Schema::TYPE_STRING . '(1000)',
            'policy_datas' => Schema::TYPE_STRING . '(1000)',
            'status' => Schema::TYPE_SMALLINT . '(1) NOT NULL DEFAULT 1',
            'created' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'updated' => Schema::TYPE_INTEGER . '(11) NOT NULL DEFAULT 0',
            'author' => Schema::TYPE_INTEGER . '(11) NOT NULL',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('rbacp_role');
    }
}

<?php

use yii\db\Schema;

class m171129_120101_rbacp_userv_role extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('rbacp_userv_role', [
            'id' => Schema::TYPE_PK,
            'role_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'userv_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'status' => Schema::TYPE_SMALLINT . '(1) NOT NULL DEFAULT 1',
            'created' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'updated' => Schema::TYPE_INTEGER . '(11) NOT NULL',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('rbacp_userv_role1');
    }
}

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
            'name' => sprintf("%s(255) NOT NULL COMMENT '%s'",Schema::TYPE_STRING,'角色名'),
            'description' => sprintf("%s(1000) COMMENT '%s'",Schema::TYPE_STRING,'描述'),
            'policy_ids' => sprintf("%s(1000) COMMENT '%s'",Schema::TYPE_STRING,'启用的策略ids'),
            'privilege_ids' => sprintf("%s(1000) COMMENT '%s'",Schema::TYPE_STRING,''),
            'policy_datas' => sprintf("%s(1000) COMMENT '%s'",Schema::TYPE_STRING,''),
            'status' => sprintf("%s(4) NOT NULL DEFAULT 1 COMMENT '%s'",Schema::TYPE_SMALLINT,'状态：1为启用，2不启用'),
            'created' => sprintf("%s(11) NOT NULL COMMENT '%s'",Schema::TYPE_INTEGER,''),
            'updated' => sprintf("%s(11) NOT NULL COMMENT '%s'",Schema::TYPE_INTEGER,''),
            'author' => sprintf("%s(11) NOT NULL COMMENT '%s'",Schema::TYPE_INTEGER,'更新者id'),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('rbacp_role');
    }
}

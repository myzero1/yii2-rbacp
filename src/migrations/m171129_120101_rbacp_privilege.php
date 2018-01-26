<?php

use yii\db\Schema;

class m171129_120101_rbacp_privilege extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('rbacp_privilege', [
            'id' => Schema::TYPE_PK,
            'name' => sprintf("%s(255) NOT NULL COMMENT '%s'",Schema::TYPE_STRING,'功能权限名称及action名称'),
            'description' => sprintf("%s(500) COMMENT '%s'",Schema::TYPE_STRING,'描述'),
            'url' => sprintf("%s(500) NOT NULL COMMENT '%s'",Schema::TYPE_STRING,'请求url，如/rate/area/add,若为all标示全局设置'),
            'status' => sprintf("%s(4) NOT NULL DEFAULT 1 COMMENT '%s'",Schema::TYPE_SMALLINT,'状态：1为启用，2不启用'),
            'created' => sprintf("%s(11) NOT NULL COMMENT '%s'",Schema::TYPE_INTEGER,''),
            'updated' => sprintf("%s(11) NOT NULL COMMENT '%s'",Schema::TYPE_INTEGER,''),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('rbacp_privilege');
    }
}

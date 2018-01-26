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

        $this->batchInsert ( $table = 'rbacp_role', 
            $columns = [
                'id',
                'name',
                'description',
                'policy_ids',
                'privilege_ids',
                'policy_datas',
                'status',
                'created',
                'updated',
                'author',
            ], 
            $rows = [
                [
                    '1', 
                    'rbacpRoleTester', 
                    'This is a test role', 
                    '1,3,10,11,12,6,7,8,14,15', 
                    '15,2,4,1,3,6,8,5,7,12,14,11,13,9,10', 
                    '{\"1\":[\"id\",\"name\",\"description\",\"sku\",\"type\",\"scope\",\"status\"],\"10\":[\"id\",\"name\",\"url\",\"status\",\"description\",\"updated\"],\"6\":[\"id\",\"name\",\"description\",\"status\",\"updated\",\"author\"],\"14\":[\"username\",\"role_name\"]}', 
                    '1', 
                    '1516802360', 
                    '1516896471', 
                    '1'
                ],
                [
                    '2', 
                    'rbacpRoleTester2', 
                    '  This is a test role', 
                    '', 
                    '15', 
                    '[]', 
                    '1', 
                    '1516893167', 
                    '1516893167', 
                    '2'
                ],
            ] );
    }

    public function down()
    {
        $this->dropTable('rbacp_role');
    }
}

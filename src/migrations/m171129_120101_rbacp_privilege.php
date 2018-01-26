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

        $this->batchInsert ( $table = 'rbacp_privilege', 
            $columns = [
                'id',
                'name',
                'description',
                'url',
                'status',
                'created',
                'updated',
            ], 
            $rows = [
                [
                    '1',
                    'rbacp策略列表',
                    '',
                    '/rbacp/rbacp-policy/index',
                    '1',
                    '1516354252',
                    '1516810915'
                ],
                [
                    '2',
                    'rbacp策略创建',
                    '',
                    '/rbacp/rbacp-policy/create',
                    '1',
                    '1516807052',
                    '1516807390'
                ],
                [
                    '3',
                    'rbacp策略修改',
                    '',
                    '/rbacp/rbacp-policy/update',
                    '1',
                    '1516807085',
                    '1516807370'
                ],
                [
                    '4',
                    'rbacp策略删除',
                    '',
                    '/rbacp/rbacp-policy/delete',
                    '1',
                    '1516807111',
                    '1516807339'
                ],
                [
                    '5',
                    'rbacp权限列表',
                    '',
                    '/rbacp/rbacp-privilege/index',
                    '1',
                    '1516807428',
                    '1516807428'
                ],
                [
                    '6',
                    'rbacp权限创建',
                    '',
                    '/rbacp/rbacp-privilege/create',
                    '1',
                    '1516807466',
                    '1516807466'
                ],
                [
                    '7',
                    'rbacp权限修改',
                    '',
                    '/rbacp/rbacp-privilege/update',
                    '1',
                    '1516807495',
                    '1516807495'
                ],
                [
                    '8',
                    'rbacp权限删除',
                    '',
                    '/rbacp/rbacp-privilege/delete',
                    '1',
                    '1516807522',
                    '1516807522'
                ],
                [
                    '9',
                    'rbacp授权列表',
                    '',
                    '/rbacp/rbacp-user-view/index',
                    '1',
                    '1516807618',
                    '1516807892'
                ],
                [
                    '10',
                    'rbacp授权修改',
                    '',
                    '/rbacp/rbacp-user-view/update',
                    '1',
                    '1516807655',
                    '1516807880'
                ],
                [
                    '11',
                    'rbacp角色列表',
                    '',
                    '/rbacp/rbacp-role/index',
                    '1',
                    '1516807737',
                    '1516807831'
                ],
                [
                    '12',
                    'rbacp角色创建',
                    '',
                    '/rbacp/rbacp-role/create',
                    '1',
                    '1516807764',
                    '1516807764'
                ],
                [
                    '13',
                    'rbacp角色修改',
                    '',
                    '/rbacp/rbacp-role/update',
                    '1',
                    '1516807788',
                    '1516807788'
                ],
                [
                    '14',
                    'rbacp角色删除',
                    '',
                    '/rbacp/rbacp-role/delete',
                    '1',
                    '1516807807',
                    '1516808238'
                ],
                [
                    '15',
                    'rbacp首页',
                    '',
                    '/rbacp/default/index',
                    '1',
                    '1516885877',
                    '1516885877'
                ],
                [
                    '16',
                    'rbacp数据库',
                    '',
                    '/rbacp/default/migrate-up',
                    '1',
                    '1516885929',
                    '1516885929'
                ],
            ] );
    }

    public function down()
    {
        $this->dropTable('rbacp_privilege');
    }
}

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

        $rulesColumn = <<<'s'
分类规则：如查询策略{"innerJoinParam":"return [];","where":"$sAuthZone = \\\\Yii::$app->user->identity->auth_zones;$aAuthZone = explode('','',trim($sAuthZone));return [''in'',''area_process.area_id'',$aAuthZone];"}|显示列{"function":"display_column","data":{"service_code":"场所编号","service_name":"场所名称","maintain_account":"云更新账号","area_name":"所在区域","warning_times":"触警统计","time":"统计时间","punish_content":"处罚内容"}}|按钮显示{"function":"show","data":{}}|参数检查{"function":"$sServiceCode =\\\\Yii::$app->request->queryParams[''service_code'']; $oPlace = \\\\backend\\\\models\\\\Place::find()->where([''service_code''=>$sServiceCode])->one(); $aAuthorZone=explode('','', trim(\\\\Yii::$app->user->identity->auth_zones)); if ($oPlace && in_array($oPlace->area_id, $aAuthorZone)) {     return TRUE; } else {     return FALSE; }","format":"php_function"};
s;

        $this->createTable('rbacp_policy', [
            'id' => Schema::TYPE_PK,
            'name' => sprintf("%s(255) NOT NULL COMMENT '%s'",Schema::TYPE_STRING,'策略名称'),
            'description' => sprintf("%s(500) COMMENT '%s'",Schema::TYPE_STRING,'分类描述'),
            'rules' => sprintf("%s(1000) NOT NULL COMMENT '%s'",Schema::TYPE_STRING,$rulesColumn),
            'scope' => sprintf("%s(4) NOT NULL DEFAULT 1 COMMENT '%s'",Schema::TYPE_SMALLINT,'作用域：1/局部作用（用户可选），2/全局作用（默认启用用户不可选）'),
            'sku' => sprintf("%s(255) NOT NULL COMMENT '%s'",Schema::TYPE_STRING,'决策的唯一标示：如rate|area|edit|rbacpPolicy|tag|区域名称'),
            'type' => sprintf("%s(4) NOT NULL COMMENT '%s'",Schema::TYPE_SMALLINT,'决策类型：1/tag页面元素，2/list列表页，3/read数据库查询，4/param参数验证'),
            'privilege_id' => sprintf("%s(11) NOT NULL COMMENT '%s'",Schema::TYPE_INTEGER,'action Id'),
            'status' => sprintf("%s(4) NOT NULL DEFAULT 1 COMMENT '%s'",Schema::TYPE_SMALLINT,'状态：1为启用，2不启用'),
            'created' => sprintf("%s(11) NOT NULL COMMENT '%s'",Schema::TYPE_INTEGER,''),
            'updated' => sprintf("%s(11) NOT NULL COMMENT '%s'",Schema::TYPE_INTEGER,''),
        ], $tableOptions);

        $this->batchInsert ( $table = 'rbacp_policy', 
            $columns = [
                'id',
                'name',
                'description',
                'rules',
                'scope',
                'sku',
                'type',
                'privilege_id',
                'status',
                'created',
                'updated',
            ], 
            $rows = [
                [
                    '1',
                    'rbacp策略列表列数显示策略',
                    '',
                    '{"function":"display_column","data":{"id":"策略ID", "name":"策略名称", "description":"策略描述", "sku":"策略SKU", "type":"策略类型", "scope":"策略作用域", "status":"策略状态", "rules":"策略规则"}}',
                    '1',
                    'rbacp|rbacp-policy|index|rbacpPolicy|list|rbacp策略列表',
                    '2',
                    '1',
                    '1',
                    '1516354524',
                    '1516883923'
                ],
                [
                    '2',
                    'rbacp策略列表添加按钮',
                    '',
                    '{"function":"show","data":{}}',
                    '1',
                    'rbacp|rbacp-policy|index|rbacpPolicy|tag|rbacp策略列表创建按钮',
                    '1',
                    '1',
                    '1',
                    '1516807287',
                    '1516884731'
                ],
                [
                    '3',
                    'rbacp策略列表修改按钮',
                    '',
                    '{"function":"show","data":{}}',
                    '1',
                    'rbacp|rbacp-policy|index|rbacpPolicy|tag|rbacp策略列表修改按钮',
                    '1',
                    '1',
                    '1',
                    '1516884819',
                    '1516884819'
                ],
                [
                    '4',
                    'rbacp策略列表删除按钮',
                    '',
                    '{"function":"show","data":{}}',
                    '1',
                    'rbacp|rbacp-policy|index|rbacpPolicy|tag|rbacp策略列表删除按钮',
                    '1',
                    '1',
                    '1',
                    '1516884885',
                    '1516884885'
                ],
                [
                    '5',
                    'rbacp角色列表查询策略',
                    '',
                    '{"innerJoinParam":"return [];","where":"return [\'in\',\'rbacp_role.author\',\\\\Yii::$app->user->id];"}',
                    '2',
                    'rbacp|rbacp-role|index|rbacpPolicy|read|角色列表',
                    '3',
                    '11',
                    '1',
                    '1503023912',
                    '1516892955'
                ],
                [
                    '6',
                    'rbacp用户列表列数显示的列',
                    '',
                    '{"function":"display_column","data":{"id":"ID", "name":"名称", "description":"描述", "status":"状态", "created":"创建时间", "updated":"更新时间", "author":"作者"}}',
                    '1',
                    'rbacp|rbacp-role|index|rbacpPolicy|list|角色列表',
                    '2',
                    '11',
                    '1',
                    '1503024317',
                    '1503024588'
                ],
                [
                    '7',
                    'rbacp角色列表显示创建按钮',
                    '',
                    '{"function":"show","data":{}}',
                    '1',
                    'rbacp|rbacp-role|index|rbacpPolicy|tag|角色列表创建按钮',
                    '1',
                    '11',
                    '1',
                    '1503024436',
                    '1503024436'
                ],
                [
                    '8',
                    'rbacp角色列表修改按钮',
                    '',
                    '{"function":"show","data":{}}',
                    '1',
                    'rbacp|rbacp-role|index|rbacpPolicy|tag|角色列表修改按钮',
                    '1',
                    '11',
                    '1',
                    '1503024514',
                    '1503024514'
                ],
                [
                    '9',
                    'rbacp角色列表删除按钮',
                    '',
                    '{"function":"show","data":{}}',
                    '1',
                    'rbacp|rbacp-role|index|rbacpPolicy|tag|角色列表删除按钮',
                    '1',
                    '11',
                    '1',
                    '1503024541',
                    '1503024541'
                ],
                [
                    '10',
                    'rbacp权限列表列数显示策略',
                    '',
                    '{"function":"display_column","data":{"id":"ID", "name":"名称", "url":"uri", "status":"状态", "description":"描述", "created":"创建时间", "updated":"修改时间"}}',
                    '1',
                    'rbacp|rbacp-privilege|index|rbacpPolicy|list|rbacp权限列表',
                    '2',
                    '5',
                    '1',
                    '1516354524',
                    '1516883923'
                ],
                [
                    '11',
                    'rbacp权限列表添加按钮',
                    '',
                    '{"function":"show","data":{}}',
                    '1',
                    'rbacp|rbacp-privilege|index|rbacpPolicy|tag|rbacp权限列表创建按钮',
                    '1',
                    '5',
                    '1',
                    '1516807287',
                    '1516884731'
                ],
                [
                    '12',
                    'rbacp权限列表修改按钮',
                    '',
                    '{"function":"show","data":{}}',
                    '1',
                    'rbacp|rbacp-privilege|index|rbacpPolicy|tag|rbacp权限列表修改按钮',
                    '1',
                    '5',
                    '1',
                    '1516884819',
                    '1516884819'
                ],
                [
                    '13',
                    'rbacp权限列表删除按钮',
                    '',
                    '{"function":"show","data":{}}',
                    '1',
                    'rbacp|rbacp-privilege|index|rbacpPolicy|tag|rbacp权限列表删除按钮',
                    '1',
                    '5',
                    '1',
                    '1516884885',
                    '1516884885'
                ],
                [
                    '14',
                    'rbacp授权列表列数显示策略',
                    '',
                    '{"function":"display_column","data":{"id":"ID", "username":"用户名称", "role_name":"角色"}}',
                    '1',
                    'rbacp|rbacp-user-view|index|rbacpPolicy|list|rbacp授权列表',
                    '2',
                    '9',
                    '1',
                    '1516354524',
                    '1516894506'
                ],
                [
                    '15',
                    'rbacp授权列表修改按钮',
                    '',
                    '{"function":"show","data":{}}',
                    '1',
                    'rbacp|rbacp-user-view|index|rbacpPolicy|tag|rbacp授权列表修改按钮',
                    '1',
                    '9',
                    '1',
                    '1516884819',
                    '1516884819'
                ],
            ] );     
    }

    public function down()
    {
        $this->dropTable('rbacp_policy');
    }
}

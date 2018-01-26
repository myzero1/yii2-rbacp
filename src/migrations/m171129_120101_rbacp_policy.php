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
    }

    public function down()
    {
        $this->dropTable('rbacp_policy');
    }
}

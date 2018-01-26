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
            'role_id' => sprintf("%s(11) NOT NULL COMMENT '%s'",Schema::TYPE_INTEGER,'角色ID'),
            'userv_id' => sprintf("%s(11) NOT NULL COMMENT '%s'",Schema::TYPE_INTEGER,'用户ID'),
            'status' => sprintf("%s(4) NOT NULL DEFAULT 1 COMMENT '%s'",Schema::TYPE_SMALLINT,'状态:1有效'),
            'created' => sprintf("%s(11) NOT NULL COMMENT '%s'",Schema::TYPE_INTEGER,'创建时间戳'),
            'updated' => sprintf("%s(11) NOT NULL COMMENT '%s'",Schema::TYPE_INTEGER,'修改时间戳'),
        ], $tableOptions);


        $this->batchInsert ( $table = 'rbacp_userv_role', 
            $columns = [
                'id',
                'role_id',
                'userv_id',
                'status',
                'created',
                'updated',
            ], 
            $rows = [
                [
                    '1', 
                    '1', 
                    '2', 
                    '1', 
                    '1516893167', 
                    '1516893167', 
                ],
            ] );
    }  

    public function down()
    {
        $this->dropTable('rbacp_userv_role');
    }
}

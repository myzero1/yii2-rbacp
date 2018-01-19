<?php

use yii\db\Schema;

class m171129_120101_rbacp_relationship extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('rbacp_relationship', [
            'id' => Schema::TYPE_PK,
            'id1' => Schema::TYPE_INTEGER . '(11) NOT NULL COMMENT "与type有关，为type关系中的前者"',
            'id2' => Schema::TYPE_INTEGER . '(11) NOT NULL COMMENT "与type有关，为type关系中的后者"',
            'type' => Schema::TYPE_SMALLINT . '(4) NOT NULL COMMENT "关系类型：1角色与用户试图，2角色与privilege，3角色与policy"',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('rbacp_relationship');
    }
}

<?php

use yii\db\Schema;

class m171129_120101_rbacp_user extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('rbacp_user', [
            'id' => Schema::TYPE_PK,
            'username' => sprintf("%s(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '%s'", Schema::TYPE_STRING, '用户名'),
            'auth_key' => sprintf("%s(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '%s'", Schema::TYPE_STRING, '授权密钥'),
            'password_hash' => sprintf("%s(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '%s'", Schema::TYPE_STRING, '密码哈希'),
            'password_reset_token' => sprintf("%s(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '%s'", Schema::TYPE_STRING, '密码重置令牌'),
            'email' => sprintf("%s(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '%s'", Schema::TYPE_STRING, '电子邮件'),
            'status' => sprintf("%s(6) NOT NULL DEFAULT 10 COMMENT '%s'", Schema::TYPE_SMALLINT, '状态：10为启用'),
            'created_at' => sprintf("%s(11) NOT NULL COMMENT '%s'", Schema::TYPE_INTEGER, '创建于'),
            'updated_at' => sprintf("%s(11) NOT NULL COMMENT '%s'", Schema::TYPE_INTEGER, '更新时间'),
            'verification_token' => sprintf("%s(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '%s'", Schema::TYPE_INTEGER, '验证令牌'),
        ], $tableOptions);

        $this->batchInsert(
            $table = 'rbacp_user',
            $columns = [
                'id',
                'username',
                'auth_key',
                'password_hash',
                'password_reset_token',
                'email',
                'status',
                'created_at',
                'updated_at',
                'verification_token',
            ],
            $rows = [
                [
                    '1',
                    'admin',
                    '234',
                    '$2y$13$dOIctGi4rkILnuMPNnZBAuNr5/ozyv16OxsUnEP/hsLczfpsO9rBm',
                    '123',
                    'rgert',
                    '10',
                    '0',
                    '0',
                    '1221',
                ],
                [
                    '2',
                    'admin2',
                    '14123',
                    '$2y$13$dOIctGi4rkILnuMPNnZBAuNr5/ozyv16OxsUnEP/hsLczfpsO9rBm',
                    '3421414',
                    '11',
                    '10',
                    '0',
                    '0',
                    '234234',
                ],
            ]
        );
    }

    public function down()
    {
        $this->dropTable('rbacp_user');
    }
}

<?php

namespace myzero1\rbacp\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class UserView extends Model
{
    public $createDefaultTable;
    public $table;
    public $id;
    public $username;
    public $status;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['table', 'id', 'username', 'status'], 'required'],
            [['createDefaultTable'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'createDefaultTable' => Yii::t('app', '生成默认用户表(user)'),
            'table' => Yii::t('app', '原始数据库中需要映射的"表名"字段(user)'),
            'id' => Yii::t('app', ' rbacp_user_view中的"用户ID"字段(id)'),
            'username' => Yii::t('app', ' rbacp_user_view中的"用户名称"字段(username)'),
            'status' => Yii::t('app', ' rbacp_user_view中的"用户状态"字段(status)'),
        ];
    }
}

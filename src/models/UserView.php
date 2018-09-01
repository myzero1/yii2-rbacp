<?php
namespace myzero1\rbacp\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class UserView extends Model
{
    public $table;
    public $id;
    public $username;
    public $status;
    public $updated;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['table','id', 'username', 'status', 'updated'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'table' => Yii::t('app', '原始数据库中需要映射的"表名"字段(user)'),
            'id' => Yii::t('app', ' rbacp_user_view中的"用户ID"字段(id)'),
            'username' => Yii::t('app', ' rbacp_user_view中的"用户名称"字段(username)'),
            'status' => Yii::t('app', ' rbacp_user_view中的"用户状态"字段(status)'),
            'updated' => Yii::t('app', ' rbacp_user_view中的"更新时间"字段(updated)'),
        ];
    }
}

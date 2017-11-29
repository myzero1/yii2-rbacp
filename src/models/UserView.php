<?php
namespace myzero1\rbacp\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class UserView extends Model
{
    public $id;
    public $username;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'username'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', ' rbacp_user_view中的"用户ID"字段(user.id)'),
            'username' => Yii::t('app', ' rbacp_user_view中的"用户名称"字段(user.username)'),
        ];
    }
}
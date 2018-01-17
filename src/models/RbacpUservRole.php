<?php

namespace myzero1\rbacp\models;

use Yii;

/**
 * This is the model class for table "rbacp_userv_role".
 *
 * @property integer $role_id
 * @property integer $userv_id
 */
class RbacpUservRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rbacp_userv_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'userv_id'], 'required'],
            [['role_id', 'userv_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'role_id' => 'Role ID',
            'userv_id' => 'Userv ID',
        ];
    }
}

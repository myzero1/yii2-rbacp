<?php

namespace myzero1\rbacp\models;

use Yii;

/**
 * This is the model class for table "rbacp_userv_role".
 *
 * @property integer $id
 * @property integer $role_id
 * @property integer $userv_id
 * @property integer $status
 * @property integer $created
 * @property integer $updated
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
            [['role_id', 'userv_id', 'created', 'updated'], 'required'],
            [['role_id', 'userv_id', 'status', 'created', 'updated'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'Role ID',
            'userv_id' => 'Userv ID',
            'status' => 'Status',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}

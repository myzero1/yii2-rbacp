<?php

namespace myzero1\rbacp\models;

use Yii;
use myzero1\rbacp\models\RbacpUserView;
use myzero1\rbacp\models\RbacpRole;

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
class RbacpRolePrivilege extends RbacpActiveRecord
{
    // public $rbacp_user_view;
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
            [['id', 'role_id', 'userv_id', 'created', 'updated'], 'required'],
            [['id', 'role_id', 'userv_id', 'status', 'created', 'updated'], 'integer'],
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

    /**
     * @获取用户
     */
    public function getUser()
    {
         return $this->hasOne(RbacpUserView::className(), ['id' => 'userv_id']);
    }

    /**
     * @获取角色
     */
    public function getRole()
    {
         return $this->hasOne(RbacpRole::className(), ['id' => 'role_id']);
    }
}

<?php

namespace myzero1\rbacp\models;

use Yii;
use myzero1\rbacp\models\RbacpRole;

/**
 * This is the model class for table "rbacp_user_view".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created
 * @property integer $updated
 * @property string $auth_zones
 * @property integer $role_id
 * @property string $true_name
 * @property string $mobile
 * @property string $ip
 * @property string $last_ip
 * @property integer $last_time
 */
class RbacpUserView extends RbacpActiveRecord
{
    const STATUS_ACTIVE = 10;
    public $role_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rbacp_user_view';
    }

    public static function primaryKey(){
        return ['id'];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['id', 'status', 'created', 'updated', 'role_id', 'last_time'], 'integer'],
            // [['username', 'auth_key', 'password_hash', 'email', 'created', 'updated', 'role_id', 'true_name'], 'required'],
            // [['username', 'password_hash', 'password_reset_token', 'email', 'true_name', 'mobile', 'ip', 'last_ip'], 'string', 'max' => 255],
            // [['auth_key'], 'string', 'max' => 32],
            // [['auth_zones'], 'string', 'max' => 1000],

            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.', 'on' => 'create'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            [['status', 'id',], 'integer'],

            [['role_id',], 'safe'],



        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rbacp', '用户ID'),
            'username' => Yii::t('rbacp', '用户名称'),
            'status' => 'Status',
        ];
    }

    /**
     * @获取角色
     */
    public function getRole()
    {
        return $this->hasOne(RbacpRole::className(), ['id' => 'role_id'])
            ->viaTable('rbacp_userv_role', ['userv_id' => 'id']);
    }
}

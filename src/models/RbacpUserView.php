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
    public $password;
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

            ['password', 'required', 'on' => 'create'],
            ['password', 'string', 'min' => 6],

            [['username', 'password_hash', 'password_reset_token', 'email', 'true_name', 'mobile', 'ip', 'last_ip'], 'string', 'max' => 255],
            [['status', 'role_id', 'created', 'updated', 'last_time'], 'integer'],
            [['auth_key'], 'string', 'max' => 32],
            [['auth_zones'], 'safe'],
            [['role_id'], 'required'],
            [['password_reset_token'], 'unique'],



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
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created' => 'Created',
            'updated' => 'Updated',
            'auth_zones' => 'Auth Zones',
            'role_id' => Yii::t('rbacp', '角色必填'),
            'true_name' => Yii::t('rbacp', '用户真名'),
            'mobile' => 'Mobile',
            'ip' => 'Ip',
            'last_ip' => 'Last Ip',
            'last_time' => 'Last Time',
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

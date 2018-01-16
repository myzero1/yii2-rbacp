<?php

namespace myzero1\rbacp\models;

use Yii;
use myzero1\rbacp\models\RbacpRole;

/**
 * This is the model class for table "rbacp_user_view".
 *
 * @property integer $id
 * @property string $username
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
            ['username', 'string', 'min' => 2, 'max' => 255],
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

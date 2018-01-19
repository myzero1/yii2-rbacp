<?php

namespace myzero1\rbacp\models;

use Yii;
use myzero1\rbacp\models\RbacpRole;
use myzero1\rbacp\models\RbacpRelationship;

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
    public $role_id;
    public $relationship = 3;
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
            ['role_id', 'safe'],
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
  /*      return $this->hasOne(RbacpRole::className(), ['id' => 'id1'])
            ->viaTable('rbacp_relationship', ['id2' => 'id'])
            ->leftJoin('rbacp_relationship AS rp','rbacp_role.id = rp.id1 and rp.type=2');

*/
/*
        return $this->hasOne(RbacpRole::className(), ['id' => 'id1'])
            ->viaTable('rbacp_relationship', ['id2' => 'id']);*/

        return RbacpRole::find()
            ->join( 'LEFT OUTER JOIN', 
                'rbacp_relationship',
                'rbacp_relationship.id1 =rbacp_role.id'
            )
            ->join( 'LEFT OUTER JOIN', 
                'rbacp_user_view',
                '(rbacp_relationship.id2 = rbacp_user_view.id AND rbacp_relationship.type = 1)'
            )
            ->where(['rbacp_user_view.id'=>$this->id])
            ->one();

    }


    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['order_id' => 'id']);
    }

    public function getItems()
    {
        return $this->hasMany(Item::className(), ['id' => 'item_id'])
            ->via('orderItems');
    }


    public function getRoleRelationship ()
    {
        // return $this->hasOne(RbacpRelationship::className(), ['id2' => 'id'])->where(['type'=>1]);
        return RbacpRelationship::find()->where(['id2'=>$this->id])->one();
    }

    public function getRole3()
    {
        return $this->hasOne(RbacpRole::className(), ['id' => 'id1'])
            ->via('roleRelationship');
    }
}

<?php

namespace myzero1\rbacp\models;

use Yii;

/**
 * This is the model class for table "rbacp_policy".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $rules
 * @property integer $privilege_id
 * @property integer $status
 * @property integer $created
 * @property integer $updated
 * @property integer $scope
 * @property integer $type
 */
class RbacpPolicy extends RbacpActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rbacp_policy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'rules', 'sku', 'type', 'scope', 'privilege_id'], 'required'],
            [['status', 'created', 'updated', 'scope', 'type', 'privilege_id'], 'integer'],
            [['name', 'sku'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 500],
            [['rules'], 'string', 'max' => 1000],

            [['name'], '\myzero1\rbacp\components\validators\NoSpecialStrValidator', 'min' => 6, 'max'=>180],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rbacp', '策略ID'),
            'name' => Yii::t('rbacp', '策略名称'),
            'description' => Yii::t('rbacp', '策略描述'),
            'rules' => Yii::t('rbacp', '策略规则'),
            'sku' => Yii::t('rbacp', '策略SKU'),
            'status' => Yii::t('rbacp', '策略状态'),
            'created' => Yii::t('rbacp', 'Created'),
            'updated' => Yii::t('rbacp', 'Updated'),
            'scope' => Yii::t('rbacp', '作用域'),
            'type' => Yii::t('rbacp', '策略类型'),
            'privilege_id' => Yii::t('rbacp', '权限id'),
        ];
    }

    /**
     * Set the value of type
     */
    public static function type()
    {
        return [
            '1' => Yii::t('rbacp', '页面元素'),
            '2' => Yii::t('rbacp', '列表的列'),
            '3' => Yii::t('rbacp', '数据查询'),
            '4' => Yii::t('rbacp', '参数验证'),
        ];
    }

    /**
     * Set the value of scope
     */
    public static function scope()
    {
        return [
            '1' => Yii::t('rbacp', '局部可选'),
            '2' => Yii::t('rbacp', '全局必须'),
        ];
    }
}

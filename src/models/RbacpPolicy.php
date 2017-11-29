<?php

namespace rbacp\models;

use Yii;

/**
 * This is the model class for table "rbacp_policy".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $rules
 * @property integer $scope
 * @property string $sku
 * @property integer $type
 * @property integer $privilege_id
 * @property integer $status
 * @property integer $created
 * @property integer $updated
 */
class RbacpPolicy extends \yii\db\ActiveRecord
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
            [['name', 'rules', 'sku', 'type', 'privilege_id', 'created', 'updated'], 'required'],
            [['scope', 'type', 'privilege_id', 'status', 'created', 'updated'], 'integer'],
            [['name', 'sku'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 500],
            [['rules'], 'string', 'max' => 1000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'rules' => 'Rules',
            'scope' => 'Scope',
            'sku' => 'Sku',
            'type' => 'Type',
            'privilege_id' => 'Privilege ID',
            'status' => 'Status',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}

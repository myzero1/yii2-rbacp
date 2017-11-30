<?php

namespace myzero1\rbacp\models;

use Yii;

/**
 * This is the model class for table "rbacp_role".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $policy_ids
 * @property string $privilege_ids
 * @property string $policy_datas
 * @property integer $status
 * @property integer $created
 * @property integer $updated
 * @property integer $author
 */
class RbacpRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rbacp_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'created', 'author'], 'required'],
            [['status', 'created', 'updated', 'author'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 500],
            [['policy_ids', 'privilege_ids', 'policy_datas'], 'string', 'max' => 1000],
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
            'policy_ids' => 'Policy Ids',
            'privilege_ids' => 'Privilege Ids',
            'policy_datas' => 'Policy Datas',
            'status' => 'Status',
            'created' => 'Created',
            'updated' => 'Updated',
            'author' => 'Author',
        ];
    }
}

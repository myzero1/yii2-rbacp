<?php

namespace myzero1\rbacp\models;

use Yii;

/**
 * This is the model class for table "rbacp_privilege".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $url
 * @property integer $status
 * @property integer $created
 * @property integer $updated
 */
class RbacpPrivilege extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rbacp_privilege';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'url', 'created', 'updated'], 'required'],
            [['status', 'created', 'updated'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['description', 'url'], 'string', 'max' => 500],
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
            'url' => 'Url',
            'status' => 'Status',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}

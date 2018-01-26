<?php

namespace myzero1\rbacp\models;

use Yii;

/**
 * This is the model class for table "rbacp_relationship".
 *
 * @property integer $id1
 * @property integer $id2
 * @property integer $type
 */
class RbacpRelationship extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rbacp_relationship';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id1', 'id2', 'type'], 'required'],
            [['id1', 'id2', 'type'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id1' => 'ID1',
            'id2' => 'ID2',
            'type' => 'Type'
        ];
    }
}

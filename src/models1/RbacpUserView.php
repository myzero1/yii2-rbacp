<?php

namespace myzero1\rbacp\models;

use Yii;

/**
 * This is the model class for table "rbacp_user_view".
 *
 * @property integer $id
 * @property string $username
 */
class RbacpUserView extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function primaryKey(){
        return 'id';
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rbacp_user_view';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['username'], 'required'],
            [['username'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
        ];
    }
}

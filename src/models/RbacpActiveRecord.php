<?php

namespace myzero1\rbacp\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Setting the default vaules
 *
 */
class RbacpActiveRecord extends \yii\db\ActiveRecord
{
    /**
     * Set the value of attributes
     */
    public function behaviors()
    {
        return [
            'status' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'status'
                ],
                'value' => 1,
            ],
            'create_update' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created',
                'updatedAtAttribute' => 'updated',
            ],
        ];
    }

    /**
     * Set the value of attributes
     */
    public static function status()
    {
        return [
            '1' => Yii::t('rbacp', '启用'),
            '2' => Yii::t('rbacp', '禁用'),
        ];
    }
}

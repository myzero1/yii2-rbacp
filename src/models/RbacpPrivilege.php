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
class RbacpPrivilege extends RbacpActiveRecord
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
            [['id', 'status', 'created', 'updated'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['description', 'url'], 'string', 'max' => 500],

            [['name'], '\myzero1\rbacp\components\validators\NoSpecialStrValidator', 'min' => 6, 'max'=>180],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rbacp', 'ID'),
            'name' => Yii::t('rbacp', '名称'),
            'description' => Yii::t('rbacp', '描述'),
            'url' => Yii::t('rbacp', 'Uri'),
            'status' => Yii::t('rbacp', '状态'),
            'created' => Yii::t('rbacp', '创建时间'),
            'updated' => Yii::t('rbacp', '更新时间'),
        ];
    }
}

<?php
namespace myzero1\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class Captcha extends Model
{
    public $verifyCode;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['verifyCode', 'captcha'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => Yii::t('app', '验证码'),
        ];
    }
}
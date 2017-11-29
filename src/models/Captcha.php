<?php
namespace myzero1\rbacp\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class Captcha extends Model
{
    public $verifyCode;
    public $test;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['verifyCode','required', 'on' => 'php'],
            ['verifyCode', 'captcha', 'captchaAction'=>'/captcha/default/captcha', 'on' => 'jsPhp'],
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
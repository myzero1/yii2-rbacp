<?php

namespace myzero1\rbacp;

use Yii;
use yii\base\BootstrapInterface;
use yii\web\ForbiddenHttpException;

/**
 * captcha module definition class
 */
class Module extends \yii\base\Module implements BootstrapInterface
{
    public $fixedVerifyCode = YII_ENV_TEST ? 'testme' : null;
    public $backColor = 0x000000;//背景颜色
    public $maxLength = 3; //最大显示个数
    public $minLength = 3;//最少显示个数
    public $padding = 5;//间距
    public $height = 40;//高度
    public $width = 80;  //宽度
    public $foreColor = 0xffffff;     //字体颜色
    public $offset = 4;        //设置字符偏移量 有效果
    public $transparent = false;        //设置字符偏移量 有效果

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'myzero1\rbacp\controllers';


    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        $app->attachBehavior('captchaValidateBehavior',[
                'class' => \myzero1\rbacp\behaviors\CaptchaValidateBehavior::class,
            ]
        );

    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

}

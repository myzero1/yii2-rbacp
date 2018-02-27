<?php

namespace myzero1\rbacp;

use Yii;
use yii\base\BootstrapInterface;
use yii\web\ForbiddenHttpException;

/**
 * captcha module definition class
 */
class Module extends \yii\base\Module
{

    /**
     * @inheritdoc
     */
    // public $controllerNamespace = 'myzero1\rbacp\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (is_null(\Yii::$app->controller)) { // 解决在使用dropDownList的时会非法的实例化rbacp模块，从而修改theme
            \Yii::$app->view->theme = new \yii\base\Theme([
                'pathMap' => ['@app/views' => '@vendor/myzero1/yii2-rbacp/src/themes/adminlte/views'],
                'baseUrl' => '@web/themes/adminlte',
            ]);
        }
    }

}

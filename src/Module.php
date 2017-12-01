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
    public $controllerNamespace = 'myzero1\rbacp\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        \Yii::$app->view->theme = new \yii\base\Theme([
            'pathMap' => ['@app/views' => '@vendor/myzero1/yii2-rbacp/src/themes/adminlte/views'],
            'baseUrl' => '@web/themes/adminlte',
        ]);
    }

}

<?php

namespace myzero1\rbacp;

use yii\base\BootstrapInterface;

/**
 * Rbacp module bootstrap class.
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public $moduleName = 'rbacp';

    /**
     * @inheritdoc
     */
    public $moduleParams = [];

    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        $this->addConfig($app);
        $this->addBehaviors($app);
        $this->rewriteLibs($app);
    }

    private function addConfig($app){
        $aConfig = require(__DIR__ . '/main.php');

        $app->params['rbacp'] = $aConfig['params'];
    }

    private function addBehaviors($app){
        $app->attachBehavior ( 'GlobalAccessBehavior', [
            'class' => '\myzero1\rbacp\behaviors\GlobalAccessBehavior',
            'rules' => $app->params['rbacp']['accessRules']        
        ]);
    }

    private function rewriteLibs($app){
        \Yii::$classMap['yii\web\Controller'] = '@rbacp/components/libs/Controller.php';
        \Yii::$classMap['yii\db\QueryTrait'] = '@rbacp/components/libs/QueryTrait.php';
        \Yii::$classMap['yii\grid\GridView'] = '@rbacp/components/libs/GridView.php';
        \Yii::$classMap['yii\helpers\BaseHtml'] = '@rbacp/components/libs/BaseHtml.php';
    }
}
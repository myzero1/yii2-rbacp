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
        $this->addRbacpModule($app);
    }

    private function addConfig($app){
        $aConfig = require(__DIR__ . '/main.php');

        $app->params['rbacp'] = $aConfig['params']['rbacp'];

        if (isset($aConfig['params']['urlManager']['rules'])) {
            $app->urlManager->addRules(
                $aConfig['params']['urlManager']['rules'],
                false
            );
        }
    }

    private function addBehaviors($app){
        $app->attachBehavior ( 'GlobalAccessBehavior', [
            'class' => '\myzero1\rbacp\behaviors\GlobalAccessBehavior'        
        ]);
    }

    private function rewriteLibs($app){
        // \Yii::$classMap['yii\web\Controller'] = '@rbacp/components/libs/Controller.php';
    }

    private function addRbacpModule($app){
    }
}
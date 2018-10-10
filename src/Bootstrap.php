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
    public $params = [];

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
        $this->addTranslations($app);
        $this->addBehaviors($app);
        $this->rewriteLibs($app);
        // $this->addRbacpModule($app);
    }

    private function addConfig($app){
        $aConfig = require(__DIR__ . '/main.php');

        $rbacpParams = array_merge($aConfig['params'], $this->params);

        $app->params['rbacp'] = $rbacpParams['rbacp'];

        if (isset($rbacpParams['urlManager']['rules'])) {
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
        \Yii::$classMap['yii\grid\GridView'] = '@vendor/myzero1/yii2-rbacp/src/components/libs/GridView.php';
        \Yii::$classMap['yii\helpers\BaseHtml'] = '@vendor/myzero1/yii2-rbacp/src/components/libs/BaseHtml.php';
        \Yii::$classMap['yii\db\QueryTrait'] = '@vendor/myzero1/yii2-rbacp/src/components/libs/QueryTrait.php';
    }

    private function addRbacpModule($app){
        $app->setModule('rbacp',
            [
                'class' => '\myzero1\rbacp\Module'
            ]
        );
    }

    private function addTranslations($app){
        $aParseNamespace = $this->parseNamespace();//myzero1\rbacp
        $sTranslationKey = $aParseNamespace[1];
        if ( !isset( $app->i18n->translations[$sTranslationKey] ) ) {
            $app->i18n->translations[$sTranslationKey] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@vendor/myzero1/' . $sTranslationKey .'/messages',
                'forceTranslation' => true,
                'fileMap' => [
                    $sTranslationKey => $sTranslationKey . '.php',
                ],
            ];

            $app->i18n->translations[$sTranslationKey . '_init'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@@vendor/myzero1/' . $sTranslationKey .'/messages',
                'forceTranslation' => true,
                'fileMap' => [
                    $sTranslationKey . '_init' => $sTranslationKey . '_init.php',
                ],
            ];
        }
    }

    private function parseNamespace(){
        $nameNamespace = get_class( $this );
        $aParseNamespace = explode( '\\', $nameNamespace );
        return $aParseNamespace;
    }
}
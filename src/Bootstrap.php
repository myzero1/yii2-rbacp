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
        // $this->addAliases($app);
        // $this->addRules($app);
        $this->addTranslations($app);
        // $this->addBehaviors($app);
        $this->addCustom($app);
        // $this->rewriteLibs($app);
    }

    private function addAliases($app){
        $aParseNamespace = $this->parseNamespace();
        if ( $aParseNamespace[1] == 'modules' ) {
            $aAliases = ['@' . $aParseNamespace[2] => __DIR__,];
        } else {
            $aAliases = ['@' . $aParseNamespace[2] => __DIR__,];
        }
        $app->setAliases ( $aAliases );
    }

    private function addRules($app){
        $aConfig = require(__DIR__ . '/main.php');
        if (isset($aConfig['params']['urlManager']['rules'])) {
            $app->urlManager->addRules(
                $aConfig['params']['urlManager']['rules'],
                false
            );
        }
    }

    private function addTranslations($app){
        $aParseNamespace = $this->parseNamespace();
        if ( !isset( $app->i18n->translations['rbacp'] ) ) {
            $app->i18n->translations['rbacp'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => 'messages',
                'forceTranslation' => true,
                'fileMap' => [
                    'rbacp' => 'rbacp.php',
                ],
            ];
        }
    }

    private function addCustom($app){
        $app->setModule($this->moduleName,
                [
                    'class' => 'myzero1\rbacp\Module'
                ]
            );
    }

    private function rewriteLibs($app){
        \Yii::$classMap['yii\web\Controller'] = '@rbacp/components/libs/Controller.php';
        \Yii::$classMap['yii\db\QueryTrait'] = '@rbacp/components/libs/QueryTrait.php';
        \Yii::$classMap['yii\grid\GridView'] = '@rbacp/components/libs/GridView.php';
        \Yii::$classMap['yii\helpers\BaseHtml'] = '@rbacp/components/libs/BaseHtml.php';
    }

    private function parseNamespace(){
        $nameNamespace = get_class( $this );
        $aParseNamespace = explode( '\\', $nameNamespace );
        return $aParseNamespace;
    }
}

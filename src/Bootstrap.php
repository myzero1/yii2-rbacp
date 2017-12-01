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
        // $this->addTranslations($app);
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
        $sTranslationKey = $aParseNamespace[2];
        if ( !isset( $app->i18n->translations[$sTranslationKey] ) ) {
            $app->i18n->translations[$sTranslationKey] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@' . $sTranslationKey .'/messages',
                'forceTranslation' => true,
                'fileMap' => [
                    $sTranslationKey => $sTranslationKey . '.php',
                    $sTranslationKey . '_init' => $sTranslationKey . '_init.php',
                ],
            ];

            $app->i18n->translations[$sTranslationKey . '_init'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@' . $sTranslationKey .'/messages',
                'forceTranslation' => true,
                'fileMap' => [
                    $sTranslationKey . '_init' => $sTranslationKey . '_init.php',
                ],
            ];
        }
    }

    private function addCustom($app){
        var_dump($this->parseNamespace());exit;
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

<?php

namespace myzero1\rbacp;

use Yii;
use yii\base\BootstrapInterface;
use yii\web\ForbiddenHttpException;
use yii\base\View;
use yii\base\Controller;
use yii\base\Application;

/**
 * This is the main module class for the z1rbacp module.
 *
 *
 * @author myzero1 <myzero1@sina.com>
 * @since 2.0
 */
class ModuleBootstrap extends \yii\base\Module implements BootstrapInterface
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
    }


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
                'pathMap' => ['@app/views' => '@vendor/myzero1/yii2-theme-adminlteiframe/src/views'],
                // 'baseUrl' => '@web/themes/adminlte',
            ]);
        }

        // $routeA =  explode('/', \Yii::$app->requestedRoute);
        $routeA =  explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        $moduleId = $routeA[0];
        \Yii::$app->params['homeMenu'] = [
                'id' => "-1",
                'title' => "rbacp首页",
                'close' => false,
                'url' => "/$moduleId/default/home",
                'urlType' => "abosulte"
            ];
        \Yii::$app->params['menu'] = [
                [
                    'id' => "-2",
                    'text' => "header",
                    'icon' => "",
                    'isHeader' => true,
                ],
                [
                    'id' => "-1",
                    'text' => "rbacp首页",
                    'icon' => "fa fa-dashboard",
                    'targetType' => 'iframe-tab',
                    'urlType' => 'abosulte',
                    'url' => "/$moduleId/default/home",
                ],
                [
                    'id' => "rbacp数据库",
                    'text' => "rbacp数据库",
                    'icon' => "fa fa-database",
                    'children' => [
                        [
                            'id' => "rbacp添加数据",
                            'text' => "rbacp添加数据",
                            'icon' => "fa fa-circle-o",
                            'targetType' => 'iframe-tab',
                            'urlType' => 'abosulte',
                            'url' => "/$moduleId/default/migrate-up",
                        ],
                        [
                            'id' => "rbacp删除数据",
                            'text' => "rbacp删除数据",
                            'icon' => "fa fa-circle-o",
                            'targetType' => 'iframe-tab',
                            'urlType' => 'abosulte',
                            'url' => "/$moduleId/default/migrate-down",
                        ],
                    ],
                ],
                [
                    'id' => "rbacp权限管理",
                    'text' => "rbacp权限管理",
                    'icon' => "fa fa-cubes",
                    'children' => [
                        [
                            'id' => "角色管理",
                            'text' => "角色管理",
                            'icon' => "fa fa-circle-o",
                            'targetType' => 'iframe-tab',
                            'urlType' => 'abosulte',
                            'url' => "/$moduleId/rbacp-role/index",
                        ],
                        [
                            'id' => "授权管理",
                            'text' => "授权管理",
                            'icon' => "fa fa-circle-o",
                            'targetType' => 'iframe-tab',
                            'urlType' => 'abosulte',
                            'url' => "/$moduleId/rbacp-user-view/index",
                        ],
                        [
                            'id' => "功能权限",
                            'text' => "功能权限",
                            'icon' => "fa fa-circle-o",
                            'targetType' => 'iframe-tab',
                            'urlType' => 'abosulte',
                            'url' => "/$moduleId/rbacp-privilege/index",
                        ],
                        [
                            'id' => "数据策略",
                            'text' => "数据策略",
                            'icon' => "fa fa-circle-o",
                            'targetType' => 'iframe-tab',
                            'urlType' => 'abosulte',
                            'url' => "/$moduleId/rbacp-policy/index",
                        ],
                    ],
                ],
            ];
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
                'basePath' => '@vendor/myzero1/' . $sTranslationKey .'/messages',
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

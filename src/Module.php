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
                'pathMap' => ['@app/views' => '@vendor/myzero1/yii2-theme-adminlteiframe/src/views'],
                // 'baseUrl' => '@web/themes/adminlte',
            ]);
        }

        $routeA =  explode('/', \Yii::$app->requestedRoute);
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

}

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
    public $theme = 'adminlteiframe'; // adminlteiframe,adminlte

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

        \Yii::$app->view->theme = new \yii\base\Theme([
            'pathMap' => ['@app/views' => '@vendor/myzero1/yii2-theme-adminlteiframe/src/views/'.$this->theme],
            // 'baseUrl' => '@web/themes/adminlte',
        ]);

        // \Yii::$app->layoutPath = '@vendor/myzero1/yii2-theme-adminlteiframe/src/views/'.$this->theme.'/layouts';
        // \Yii::$app->layout = 'main'; // default

        $routeA =  explode('/', \Yii::$app->requestedRoute);
        $moduleId = $routeA[0];
        $requestedRoute = trim(\Yii::$app->requestedRoute,'/');

        $this->params['menu'] = [
            // [
            //     'id' => "-2",
            //     'text' => "header",
            //     'icon' => "",
            //     'isHeader' => true,
            // ],
            [
                'id' => "-1",
                'text' => "rbacp首页",
                'icon' => "fa fa-dashboard",
                'targetType' => 'iframe-tab',
                'urlType' => 'abosulte',
                'url' => "/$moduleId/default/home",
                'isHome' => true,
                'active' => in_array($requestedRoute, ["$moduleId","$moduleId/default","$moduleId/default/index","$moduleId/default/home"]),
            ],
            [
                'id' => "rbacp数据库",
                'text' => "rbacp数据库",
                'icon' => "fa fa-database",
                'url' => '#',
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
                'url' => '#',
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

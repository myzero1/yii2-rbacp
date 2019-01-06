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

        if ($this->theme == 'adminlteiframe') {
            $this->defaultRoute = 'adminlteiframe/layout'; // for adminlteiframe theme
            $this->controllerMap['adminlteiframe'] = [ // for adminlteiframe theme
                'class' => 'myzero1\adminlteiframe\controllers\SiteController'
            ];
        }

        // \Yii::$app->layoutPath = '@vendor/myzero1/yii2-theme-adminlteiframe/src/views/'.$this->theme.'/layouts';
        // \Yii::$app->layout = 'main'; // default

        $routeA =  explode('/', \Yii::$app->requestedRoute);
        $moduleId = $routeA[0];
        $requestedRoute = trim(\Yii::$app->requestedRoute,'/');

        $this->params['menu'] = [
            [
                'id' => "rbacp首页",
                'text' => "rbacp首页",
                'title' => "rbacp首页",
                'icon' => "fa fa-dashboard",
                'targetType' => 'iframe-tab',
                'urlType' => 'abosulte',
                'url' => ["/$moduleId/default/index"],
                'isHome' => true,
            ],
            [
                'id' => "rbacp数据库",
                'text' => "rbacp数据库",
                'title' => "rbacp数据库",
                'icon' => "fa fa-database",
                'url' => ['#'],
                'children' => [
                    [
                        'id' => "rbacp添加数据",
                        'text' => "rbacp添加数据",
                        'title' => "rbacp添加数据",
                        'icon' => "fa fa-angle-double-right",
                        'targetType' => 'iframe-tab',
                        'urlType' => 'abosulte',
                        'url' => ["/$moduleId/default/migrate-up"],
                    ],
                    [
                        'id' => "rbacp删除数据",
                        'text' => "rbacp删除数据",
                        'title' => "rbacp删除数据",
                        'icon' => "fa fa-angle-double-right",
                        'targetType' => 'iframe-tab',
                        'urlType' => 'abosulte',
                        'url' => ["/$moduleId/default/migrate-down"],
                    ],
                ],
            ],
            [
                'id' => "rbacp权限管理",
                'text' => "rbacp权限管理",
                'title' => "rbacp权限管理",
                'icon' => "fa fa-cubes",
                'url' => ['#'],
                'children' => [
                    [
                        'id' => "角色管理",
                        'text' => "角色管理",
                        'title' => "角色管理",
                        'icon' => "fa fa-angle-double-right",
                        'targetType' => 'iframe-tab',
                        'urlType' => 'abosulte',
                        'url' => ["/$moduleId/rbacp-role/index"],
                    ],
                    [
                        'id' => "授权管理",
                        'text' => "授权管理",
                        'title' => "授权管理",
                        'icon' => "fa fa-angle-double-right",
                        'targetType' => 'iframe-tab',
                        'urlType' => 'abosulte',
                        'url' => ["/$moduleId/rbacp-user-view/index"],
                    ],
                    [
                        'id' => "功能权限",
                        'text' => "功能权限",
                        'title' => "功能权限",
                        'icon' => "fa fa-angle-double-right",
                        'targetType' => 'iframe-tab',
                        'urlType' => 'abosulte',
                        'url' => ["/$moduleId/rbacp-privilege/index"],
                    ],
                    [
                        'id' => "数据策略",
                        'text' => "数据策略",
                        'title' => "数据策略",
                        'icon' => "fa fa-angle-double-right",
                        'targetType' => 'iframe-tab',
                        'urlType' => 'abosulte',
                        'url' => ["/$moduleId/rbacp-policy/index"],
                    ],
                ],
            ],
        ];
    }

}

<?php

/**
 * Sidebar menu layout.
 *
 * @var \yii\web\View $this View
 */

use myzero1\rbacp\themes\adminlte\widgets\Menu;
use yii\helpers\Url;
use myzero1\rbacp\helper\Helper;

    $sUri = sprintf('%s/%s/%s/%s', \Yii::$app->homeUrl, \Yii::$app->controller->module->id, \Yii::$app->controller->id, \Yii::$app->controller->action->id);
    $sRbacpModuleName = Helper::getRbacpModuleName();

    $items = [
        [
            'label' => Yii::t('app', 'rbacp首页'),
            // 'url' => sprintf('/admin/%s/default/index', $sRbacpModuleName),
            'url' => [sprintf('/%s/default/index', $sRbacpModuleName)],
            'icon' => 'fa-dashboard',
            'active' => $sUri === sprintf('%s/%s/default/index', \Yii::$app->homeUrl, $sRbacpModuleName)
        ],
        [
            'label' => Yii::t('app', 'rbacp数据库'),
            // 'url' => sprintf('/admin/%s/default/index', $sRbacpModuleName),
            'url' => [sprintf('/%s/default/migrate-up', $sRbacpModuleName)],
            'icon' => 'fa-database',
            'active' => Yii::$app->request->pathInfo === sprintf('%s/default/migrate-up', $sRbacpModuleName)
        ],
        [
            'label' => Yii::t('app', 'rbacp权限管理'),
            'url' => '#',
            'icon' => ' fa-cubes',
            'visible' => true,
            'items' => [
                [
                    'label' => Yii::t('app', '角色管理'),
                    'url' => [sprintf('/%s/rbacp-role/index', $sRbacpModuleName)],
                    'visible' => true,
                    'active' => in_array(Yii::$app->request->pathInfo, [
                        sprintf('%s/rbacp-role/index', $sRbacpModuleName),
                        sprintf('%s/rbacp-role/create', $sRbacpModuleName),
                        sprintf('%s/rbacp-role/update', $sRbacpModuleName),
                    ]),
                ],
                [
                    'label' => Yii::t('app', '赋予角色'),
                    'url' => [sprintf('/%s/rbacp-user-view/index', $sRbacpModuleName)],
                    'visible' => true,
                    'active' => in_array(Yii::$app->request->pathInfo, [
                        sprintf('%s/rbacp-user-view/index', $sRbacpModuleName),
                        sprintf('%s/rbacp-user-view/update', $sRbacpModuleName),
                    ]),
                ],
                [
                    'label' => Yii::t('app', '功能权限'),
                    'url' => [sprintf('/%s/rbacp-privilege/index', $sRbacpModuleName)],
                    'visible' => true,
                    'active' => in_array(Yii::$app->request->pathInfo, [
                        sprintf('%s/rbacp-privilege/index', $sRbacpModuleName),
                        sprintf('%s/rbacp-privilege/create', $sRbacpModuleName),
                        sprintf('%s/rbacp-privilege/update', $sRbacpModuleName),
                    ]),
                ],
                [
                    'label' => Yii::t('app', '数据策略'),
                    'url' => [sprintf('/%s/rbacp-policy/index', $sRbacpModuleName)],
                    'visible' => true,
                    'active' => in_array(Yii::$app->request->pathInfo, [
                        sprintf('%s/rbacp-policy/index', $sRbacpModuleName),
                        sprintf('%s/rbacp-policy/create', $sRbacpModuleName),
                        sprintf('%s/rbacp-policy/update', $sRbacpModuleName),
                    ]),
                ],
            ]
        ],
    ];

    $sMenuItems = Yii::$app->session->get('aMenuItems');
    if (is_null($sMenuItems)) {
        if (isset(Yii::$app->modules[$sRbacpModuleName])) {
            $itemsNew = \myzero1\rbacp\components\Rbac::getMenuItems($items);
        } else {
            $itemsNew = $items;
        }
        Yii::$app->session->set('aMenuItems', json_encode($itemsNew));
    } else {
        $itemsNew = json_decode($sMenuItems, TRUE);
    }

    echo Menu::widget(
        [
            'options' => [
                'class' => 'sidebar-menu'
            ],
            // 'items' => Yii::$app->params['menu'],
            'items' => $itemsNew
        ]
    );

?>
<?php

/**
 * Sidebar menu layout.
 *
 * @var \yii\web\View $this View
 */

use myzero1\rbacp\themes\adminlte\widgets\Menu;

    $items = [
        [
            'label' => Yii::t('app', 'rbacp首页'),
            'url' => '/admin/rbacp',
            'icon' => 'fa-dashboard',
            'active' => Yii::$app->request->url === '/admin/rbacp'
        ],
        [
            'label' => Yii::t('app', 'rbacp权限管理'),
            'url' => '#',
            'icon' => ' fa-cubes',
            'visible' => true,
            'items' => [
                [
                    'label' => Yii::t('app', '角色管理'),
                    'url' => ['/rbacp/rbacp-role'],
                    'visible' => true
                ],
                [
                    'label' => Yii::t('app', '赋予角色'),
                    'url' => ['/rbacp/rbacp-user-view'],
                    'visible' => true
                ],
                [
                    'label' => Yii::t('app', '功能权限'),
                    'url' => ['/rbacp/rbacp-privilege'],
                    'visible' => true
                ],
                [
                    'label' => Yii::t('app', '数据策略'),
                    'url' => ['/rbacp/rbacp-policy'],
                    'visible' => true
                ],
            ]
        ],
    ];

    $sMenuItems = Yii::$app->session->get('aMenuItems');
    if (1||is_null($sMenuItems)) {
        if (isset(Yii::$app->modules['app'])) {
            $itemsNew = \rbacp\components\Rbacp::getMenuItems(Yii::$app->user->id, $items);
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
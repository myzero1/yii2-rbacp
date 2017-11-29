<?php

/**
 * Sidebar menu layout.
 *
 * @var \yii\web\View $this View
 */

use rbacp\themes\adminlte\widgets\Menu;

    $items = [
        [
            'label' => Yii::t('app', '产品管理后台首页1'),
            'url' => Yii::$app->homeUrl,
            'icon' => 'fa-dashboard',
            'active' => Yii::$app->request->url === Yii::$app->homeUrl
        ],
        [
            'label' => Yii::t('app', '产品管理1'),
            'url' => '#',
            'icon' => ' fa-cubes',
            'visible' => true,
            'items' => [
                [
                    'label' => Yii::t('app', '产品列表1'),
                    'url' => ['/product/index'],
                    'visible' => true
                ],
                [
                    'label' => Yii::t('app', '升级列表1'),
                    'url' => ['/upgrade/index'],
                    'visible' => true
                ],
                [
                    'label' => Yii::t('app', '公告列表1'),
                    'url' => ['/affiche/index'],
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
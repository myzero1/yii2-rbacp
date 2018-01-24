<?php

    /**
     * Sidebar menu layout.
     *
     * @var \yii\web\View $this View
     */

    use myzero1\rbacp\themes\adminlte\widgets\Menu;
    use yii\helpers\Url;
    use myzero1\rbacp\helper\Helper;

    $sUri = \myzero1\rbacp\helper\Helper::getUri();

    // var_dump($sUri);exit;

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
            'active' => $sUri === sprintf('%s/%s/default/migrate-up', \Yii::$app->homeUrl, $sRbacpModuleName)
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
                    'active' => in_array($sUri, [
                        sprintf('%s/%s/rbacp-role/index', \Yii::$app->homeUrl, $sRbacpModuleName),
                        sprintf('%s/%s/rbacp-role/create', \Yii::$app->homeUrl, $sRbacpModuleName),
                        sprintf('%s/%s/rbacp-role/update', \Yii::$app->homeUrl, $sRbacpModuleName),
                    ]),
                ],
                [
                    'label' => Yii::t('app', '授权管理'),
                    'url' => [sprintf('/%s/rbacp-user-view/index', $sRbacpModuleName)],
                    'visible' => true,
                    'active' => in_array($sUri, [
                        sprintf('%s/%s/rbacp-user-view/index', \Yii::$app->homeUrl, $sRbacpModuleName),
                        sprintf('%s/%s/rbacp-user-view/update', \Yii::$app->homeUrl, $sRbacpModuleName),
                    ]),
                ],
                [
                    'label' => Yii::t('app', '功能权限'),
                    'url' => [sprintf('/%s/rbacp-privilege/index', $sRbacpModuleName)],
                    'visible' => true,
                    'active' => in_array($sUri, [
                        sprintf('%s/%s/rbacp-privilege/index', \Yii::$app->homeUrl, $sRbacpModuleName),
                        sprintf('%s/%s/rbacp-privilege/create', \Yii::$app->homeUrl, $sRbacpModuleName),
                        sprintf('%s/%s/rbacp-privilege/update', \Yii::$app->homeUrl, $sRbacpModuleName),
                    ]),
                ],
                [
                    'label' => Yii::t('app', '数据策略'),
                    'url' => [sprintf('/%s/rbacp-policy/index', $sRbacpModuleName)],
                    'visible' => true,
                    'active' => in_array($sUri, [
                        sprintf('%s/%s/rbacp-policy/index', \Yii::$app->homeUrl, $sRbacpModuleName),
                        sprintf('%s/%s/rbacp-policy/create', \Yii::$app->homeUrl, $sRbacpModuleName),
                        sprintf('%s/%s/rbacp-policy/update', \Yii::$app->homeUrl, $sRbacpModuleName),
                    ]),
                ],
            ]
        ],
    ];

    $sMemuSessionName = sprintf('sMenuItems_%s', $sRbacpModuleName);
    $sMenuItems = Yii::$app->session->get($sMemuSessionName);
    if (1||is_null($sMenuItems)) {
        if (isset(Yii::$app->modules[$sRbacpModuleName])) {
            $itemsNew = \myzero1\rbacp\components\Rbac::getMenuItems($items);
        } else {
            $itemsNew = $items;
        }
        Yii::$app->session->set($sMemuSessionName, json_encode($itemsNew));
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
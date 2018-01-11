<?php
return [
    'components' => [
        'DealRate' => ['class' => 'rate\components\DealRate'],
        'DbcSbcConvert' => ['class' => 'rate\components\DbcSbcConvert'],
        'Rbacp' => ['class' => 'rbacp\components\Rbacp'],
    ],
    // 'on beforeAction'     => [
    //     'rate\components\BeforeAction',
    //     'sbc2Dbc'
    // ],
    'params' => [
        'model' => 'normal',//normal,rbac,rbacp
        'develop' => 1,//The id of the developer
        'denyCallback' => '',// It is will working,when model==normal
        'accessRules' => [// It is will working,when model==normal
            'excludeUri' => [
                // 'moduleId_controllerId_actionId',
            ],
            'developUri' => [
                // 'moduleId_controllerId_actionId',
            ],
        ],




        'controllerNamespace' => 'rbacp\controllers\backend',
        'urlManager' => [
            'rules' => [
                // 'rate/area/index' => 'rate/jf-core-area/index',
            ],
        ],
        'loginUri' => '/site/login',
        'developerId' => 1,
        'excludeUri' => [
            'site/login',
            'site/captcha',
            'place/get-city',
            'place/get-county',
            'place/get-result',
            'punish/get-city',
            'punish/get-county',
            'place/get-company',
            ''//首页
        ],
        'excludeUriOnLine' => [
            'site/logout',
            'user/my-profile',
            'place/place-client',
        ],
        'developUri' => [
            'rbacp/rbacp-privilege/index',
            'rbacp/rbacp-privilege/create',
            'rbacp/rbacp-privilege/update',
            'rbacp/rbacp-privilege/delete',

            'rbacp/rbacp-policy/index',
            'rbacp/rbacp-policy/create',
            'rbacp/rbacp-policy/update',
            'rbacp/rbacp-policy/delete',
        ],
    ],
];

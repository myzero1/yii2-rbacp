<?php
return [
    'params' => [
        'urlManager' => [
            'rules' => [
                // 'rate/area/index' => 'rate/jf-core-area/index',
            ],
        ],
        'rbacp' => [
            'model' => 'rbac',//everyone,logined,rbac,rbacp
            'develop' => 1,//The id of the developer
            'rbacpTester' => 2,//The id of the tester of rbacp
            'denyCallbackUri' => '/rbacp/default/rbacp403',
            'loginUri' => '/site/login',
            'accessRules' => [
                'excludeUri' => [
                    '/rbacp/default/index',
                    '/rbacp/default/rbacp403',
                ],
                'developUri' => [
                    '/rbacp/default/migrate-up',
                    '/rbacp/default/migrate-down',
                ],
            ],
        ],
    ],
];

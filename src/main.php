<?php
return [
    'params' => [
        'urlManager' => [
            'rules' => [
                // 'rate/area/index' => 'rate/jf-core-area/index',
            ],
        ],
        'rbacp' => [
            'model' => 'logined',//everyone,logined,rbac,rbacp
            'develop' => 1,//The id of the developer
            'denyCallbackUri' => '/admin/site/denyCallbackUri',
            'loginUri' => '/admin/site/login',
            'accessRules' => [
                'excludeUri' => [
                    // 'app-backend/site/index',
                    'app-backend/site/login',
                ],
                'developUri' => [
                    // 'app-backend/site/index',
                    'app-backend/user/my-profile',
                ],
            ],
        ],
    ],
];

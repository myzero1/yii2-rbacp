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
            'denyCallbackUri' => '/admin/rbacp/default/migrate-up',
            'loginUri' => '/admin/site/login',
            'accessRules' => [
                'excludeUri' => [
                    // 'app-backend/site/index',
                    'app-backend/site/logout',
                    'app-backend/site/login',
                    'rbacp/default/index',
                    'rbacp/default/migrate-up',
                ],
                'developUri' => [
                    // 'app-backend/site/index',
                    'app-backend/user/my-profile',
                ],
            ],
        ],
    ],
];

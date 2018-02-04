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
        'uilog' => [
            'aOperationLogTemplate' => [
                // 'route' => 'template',
                'rbacp/rbacp-role/update' => [
                    'templateName' => '/rbacp/rbacp-role/update',
                    'operationName' => '修改角色',
                    'identifyingTable' => 'rbacp_role',
                    'useTransaction' => FALSE,
                ],
            ],
        ],
        'beforeAction' => function() {
            Yii::$app->controller->attachBehavior('access', [
                'class' => yii\filters\AccessControl::class,
                // 'denyCallback' => $app->params['rbacp']['denyCallback'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ]);
            \myzero1\rbacp\components\Rbac::checkAction();

            echo "rbacp before action\n";
        },
    ],
];

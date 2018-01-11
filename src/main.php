<?php
return [
    'params' => [
        'urlManager' => [
            'rules' => [
                // 'rate/area/index' => 'rate/jf-core-area/index',
            ],
        ],
        'rbacp' => [
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
        ],
    ],
];

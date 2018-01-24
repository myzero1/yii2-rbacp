yii2-rbacp
========================

Access modules,including functional access and data access.

Installation
------------

The preferred way to install this module is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require myzero1/yii2-rbacp：1.*
```

or add

```
"myzero1/yii2-rbacp": "~1"
```

to the require section of your `composer.json` file.



Setting
-----

Once the extension is installed, simply modify your application configuration as follows:

```php
return [
    // ...
    'bootstrap' => [
        'captcha',
        ...
        'rbacp' => [
            'class' => \myzero1\rbacp\Bootstrap::class, // for rbacp function
            // 'params' => [
            //    'urlManager' => [
            //         'rules' => [
            //             // 'rate/area/index' => 'rate/jf-core-area/index',
            //         ],
            //     ],
            //     'rbacp' => [
            //         'model' => 'rbac',//everyone,logined,rbac,rbacp
            //         'develop' => 1,//The id of the developer
            //         'denyCallbackUri' => '/admin/rbacp/default/migrate-up',
            //         'loginUri' => '/admin/site/login',
            //         'accessRules' => [
            //             'excludeUri' => [
            //                 // 'app-backend/site/index',
            //                 'app-backend/site/logout',
            //                 'app-backend/site/login',
            //                 'rbacp/default/index',
            //                 'rbacp/default/migrate-up',
            //             ],
            //             'developUri' => [
            //                 // 'app-backend/site/index',
            //                 'app-backend/user/my-profile',
            //             ],
            //         ],
            //     ],
            // ],
        ],
    ],
    // ...
];
```


Usage
-----

Use the rbac of rbacp:

```

1. Add 


```

With ActiveForm

```

echo  $form
// ->field(new \myzero1\captcha\models\Captcha(['scenario'=>'php']),'verifyCode')
->field(new \myzero1\captcha\models\Captcha(['scenario'=>'jsPhp']),'verifyCode')
->widget(
    myzero1\captcha\widgets\Captcha::className(),
    [
        'imageOptions'=>[
            'alt'=>'点击换图',
            'title'=>'点击换图',
            'style'=>'cursor:pointer'
        ]
    ]
)


```

The scenario discretion
- php: Just validate by PHP.
- jsPhp: validate by JS and PHP

You can access Demo through the following URL:

```
http://localhost/path/to/index.php?r=captcha/default/demo
```

or if you have enabled pretty URLs, you may use the following URL:

```
http://localhost/path/to/index.php/captcha/default/demo
```

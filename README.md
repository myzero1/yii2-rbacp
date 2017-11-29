yii2-rbacp
========================

Simple captcha for yii2.Just add the module in config file and use the widget.


Installation
------------

The preferred way to install this module is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require myzero1/yii2-captcha：1.*
```

or add

```
"myzero1/yii2-captcha": "~1"
```

to the require section of your `composer.json` file.



Setting
-----

Once the extension is installed, simply modify your application configuration as follows:

```php
return [
	// ...
    'bootstrap' => ['captcha',...],
    'modules' => [
        'captcha' => [
            'class' => 'myzero1\captcha\Module',
            // 'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            // 'backColor' => 0x605ca8,//背景颜色
            // 'maxLength' => 3, //最大显示个数
            // 'minLength' => 3,//最少显示个数
            // 'padding' => 5,//间距
            // 'height' => 40,//高度
            // 'width' => 80,  //宽度
            // 'foreColor' => 0xffffff,     //字体颜色
            // 'offset' => 4,        //设置字符偏移量 有效果
            // 'transparent' => false,        //设置字符偏移量 有效果
        ],
        // ...
    ],
    // ...
];
```


Usage
-----

Add upload widget like following:

```

echo \myzero1\captcha\widgets\Captcha::widget([
    'model' => new \myzero1\captcha\models\Captcha(['scenario'=>'js']),
    // 'model' => new \myzero1\captcha\models\Captcha(['scenario'=>'jsPhp']),
    'attribute' => 'verifyCode',
    'imageOptions'=>[
        'alt'=>'点击换图',
        'title'=>'点击换图',
        'style'=>'cursor:pointer'
    ]
]);


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

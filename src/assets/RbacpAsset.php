<?php

namespace myzero1\rbacp\assets;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

use function \myzero1\rbacp\components\CompatiblePHP\PHP8\{strlen,trim,ltrim,rtrim,strpos,str_replace,implode,htmlspecialchars};

class RbacpAsset extends AssetBundle
{
    public $sourcePath = '@vendor/myzero1/yii2-rbacp/src/assets';
    //public $baseUrl = '@web';
    public $css = [
        'css/custom.css',
    ];

    public $js = [
        'js/custom.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}

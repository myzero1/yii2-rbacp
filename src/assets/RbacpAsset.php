<?php

namespace myzero1\rbacp\assets;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

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

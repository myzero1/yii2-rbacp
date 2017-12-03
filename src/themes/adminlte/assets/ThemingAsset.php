<?php

namespace myzero1\rbacp\themes\adminlte\assets;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class ThemingAsset extends AssetBundle
{
    public $sourcePath = '@vendor/myzero1/yii2-rbacp/src/themes/adminlte/assets';
    //public $baseUrl = '@web';
    public $css = [
        'css/custom.css',
        'css/AdminLTE-local-font.min.css',
    ];

    public $js = [
        'js/custom.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        '\myzero1\rbacp\themes\adminlte\assets\common\AdminLte',
        '\myzero1\rbacp\themes\adminlte\assets\common\Html5shiv',
        '\myzero1\rbacp\themes\adminlte\assets\common\AdminLtePlugins',
    ];

    public $skin = 'skin-blue';
}

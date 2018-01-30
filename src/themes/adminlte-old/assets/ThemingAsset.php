<?php

namespace rbacpt\themes\adminlte\assets;

use yii\web\AssetBundle;

/**
 * Main asset for the `adminlte` theming
 */

class ThemingAsset extends AssetBundle
{
    public $sourcePath = '@rbacpt/themes/adminlte/assets';
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
        '\rbacpt\themes\adminlte\assets\common\AdminLte',
        '\rbacpt\themes\adminlte\assets\common\Html5shiv'
    ];

    public $skin = 'skin-blue';
}

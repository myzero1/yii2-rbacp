<?php

namespace myzero1\rbacp\themes\adminlte\assets\common;

use yii\web\AssetBundle;

/**
 * Html5shiv asset for the `adminlte` theming
 */

class AdminLtePlugins extends AssetBundle
{
    public $sourcePath = '@bower/admin-lte/plugins';
    public $js = [
        'iCheck/iCheck.min.js'
    ];
    public $css = [
        'iCheck/all.css'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\jui\JuiAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];
}

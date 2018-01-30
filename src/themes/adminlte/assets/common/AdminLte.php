<?php

namespace myzero1\rbacp\themes\adminlte\assets\common;

use yii\web\AssetBundle;

/**
 * Html5shiv asset for the `adminlte` theming
 */

class AdminLte extends AssetBundle
{
    public $sourcePath = '@bower/admin-lte/dist';
    public $js = [
        'js/app.min.js'
    ];
    public $css = [
        'css/AdminLTE.min.css',
        'css/skins/_all-skins.min.css'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        '\myzero1\rbacp\themes\adminlte\assets\common\FontAwesome',
        '\myzero1\rbacp\themes\adminlte\assets\common\JquerySlimScroll',
    ];
}

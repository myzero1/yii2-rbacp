<?php

namespace myzero1\rbacp\themes\adminlte\assets\common;

use yii\web\AssetBundle;

/**
 * Html5shiv asset for the `adminlte` theming
 */

class Html5shiv extends AssetBundle
{
    public $sourcePath = '@bower/html5shiv';
    public $js = [
        'dist/html5shiv.min.js'
    ];

    public $jsOptions = [
        'condition'=>'lt IE 9'
    ];
}
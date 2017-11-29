<?php

namespace rbacp\themes\adminlte\assets\common;

use yii\web\AssetBundle;

/**
 * JquerySlimScroll asset for the `adminlte` theming
 */

/**
 * Class JquerySlimScroll
 * @package common\assets
 * @author Eugene Terentev <eugene@terentev.net>
 */
class JquerySlimScroll extends AssetBundle
{
    public $sourcePath = '@bower/jquery-slimscroll';
    public $js = [
        'jquery.slimscroll.min.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}

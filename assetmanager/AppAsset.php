<?php

/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 09-Jun-17
 * Time: 16:10
 */

namespace app\assetmanager;

class AppAsset extends \yii\web\AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.min.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        '\rmrevin\yii\fontawesome\AssetBundle',
        'app\assetmanager\MainThemeAsset',
        'app\assetmanager\BowerAsset',
        'app\assetmanager\FontAsset',
    ];
}
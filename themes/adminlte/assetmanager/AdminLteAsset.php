<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 14-Jun-17
 * Time: 13:23
 */

namespace app\themes\adminlte\assetmanager;


use yii\web\AssetBundle;

class AdminLteAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'//cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
        'css/site.min.css',
        "adminlte/css/AdminLTE.min.css",
        //"adminlte/css/skins/_all-skins.min.css"
        "adminlte/css/skins/skin-blue.min.css"
    ];
    public $js = [
        "adminlte/js/adminlte.min.js",
//        "adminlte/js/app.min.js",
        "//code.jquery.com/ui/1.11.4/jquery-ui.min.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        '\rmrevin\yii\fontawesome\AssetBundle',
        '\app\themes\adminlte\assetmanager\BowerLteAsset',
        //'\ptrnov\fusionchart\ChartAsset',
        '\app\assetmanager\FontAsset',
    ];
}
<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 13-Jun-17
 * Time: 10:42
 */

namespace app\themes\adminlte\assetmanager;


use yii\web\AssetBundle;

class ChartLteData extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

    ];
    public $js = [
        //'data/morris-data.js',
        //'data/flot-data.js',
    ];

    public $depends = [
        //'\juratitov\morrisjs\ChartPluginAsset',
    ];
}
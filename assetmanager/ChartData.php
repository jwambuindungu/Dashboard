<?php
/**
 * @author Sammy B <barsamms@gmail.com>
 * @since 2.0
 */

namespace app\assetmanager;


use yii\web\AssetBundle;

class ChartData extends AssetBundle
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
        '\ptrnov\fusionchart\ChartAsset'
    ];
}
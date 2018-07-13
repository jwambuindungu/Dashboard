<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assetmanager;

use yii\web\AssetBundle;

/**
 * @author Sammy B <barsamms@gmail.com>
 * @since 2.0
 */
class FusionChartAsset extends AssetBundle
{

    public $sourcePath = '@bower';

    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );

    public $cssOptions = array(// 'position' => \yii\web\View::POS_END
    );

    public $css = [
        //'pace/themes/orange/pace-theme-minimal.css',
    ];

    public $js = [
        'fusioncharts/fusioncharts.js',
        'fusioncharts/fusioncharts.maps.js',
    ];

    public $publishOptions = [
        //'forceCopy'=>true,
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}

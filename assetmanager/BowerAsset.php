<?php
/**
 * @author Sammy B <barsamms@gmail.com>
 * @since 2.0
 */

namespace app\assetmanager;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class BowerAsset extends AssetBundle
{
    public $sourcePath = '@bower';

    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );

    public $cssOptions = array(// 'position' => \yii\web\View::POS_END
    );

    public $css = [
        //'//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/red/pace-theme-minimal.css',
        'pace/themes/orange/pace-theme-minimal.css',
        'metismenu/dist/metisMenu.min.css',
        'slick-carousel/slick/slick-theme.css',
    ];

    public $js = [
        'pace/pace.js',
        'metismenu/dist/metisMenu.min.js',
        'slick-carousel/slick/slick.min.js',
    ];

    public $publishOptions = [
        //'forceCopy'=>true,
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}

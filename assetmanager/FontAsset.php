<?php
/**
 * @author Sammy B <barsamms@gmail.com>
 * @since 2.0
 */
namespace app\assetmanager;

use yii\web\AssetBundle;

class FontAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'//fonts.googleapis.com/css?family=Open+Sans:400,700',
        //'//fonts.googleapis.com/css?family=Ubuntu:400,700',
        //'//fonts.googleapis.com/css?family=Oswald:400,700',
        '//fonts.googleapis.com/css?family=Josefin+Sans:300,400,600,700'
    ];
    public $cssOptions = [
        'type' => 'text/css',
    ];
}
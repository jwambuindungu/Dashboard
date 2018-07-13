<?php
/**
 * @author Sammy B <barsamms@gmail.com>
 * @since 2.0
 */
namespace app\assetmanager;


use yii\web\AssetBundle;

class MainThemeAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/sb-admin-2.min.css',
    ];
    public $js = [
        'js/sb-admin-2.min.js',
    ];
    public $depends = [
    ];
}
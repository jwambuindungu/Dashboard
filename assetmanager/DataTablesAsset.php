<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assetmanager;

use yii\web\AssetBundle;

class DataTablesAsset extends AssetBundle
{

    public $sourcePath = '@bower';

    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );

    public $cssOptions = array(// 'position' => \yii\web\View::POS_END
    );

    public $css = [
        'datatables.net-bs/css/dataTables.bootstrap.min.css',
    ];

    public $js = [
        'datatables.net/js/jquery.dataTables.min.js',
        'datatables.net-bs/js/dataTables.bootstrap.min.js',
    ];

    public $publishOptions = [
        //'forceCopy'=>true,
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}

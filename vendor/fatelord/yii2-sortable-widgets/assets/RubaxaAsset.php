<?php

namespace kotchuprik\sortable\assets;

use yii\web\AssetBundle;

class RubaxaAsset extends AssetBundle
{
    public $sourcePath = '@vendor/fatelord/yii2-sortable-widgets/assets/files';

    public $js = [
        '//cdnjs.cloudflare.com/ajax/libs/Sortable/1.5.1/Sortable.js',
        'js/jquery.binding.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}

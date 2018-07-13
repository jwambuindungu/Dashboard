<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// comment out the following two lines when deployed to production
//defined('LOCAL') or define('LOCAL', true);
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'prod');

require(__DIR__ . '/vendor/autoload.php');
require(__DIR__ . '/vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/config/web.php');

(new yii\web\Application($config))->run();

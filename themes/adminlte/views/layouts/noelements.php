<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;


\app\assetmanager\AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<?php require_once 'includes/_head.php'; ?>
<?php $this->beginBody() ?>
<body>

<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= $content ?>
</div>
<?php require_once 'includes/_footer.php' ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

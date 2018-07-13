<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

\app\themes\adminlte\assetmanager\AdminLteAsset::register($this);
?>
<?php $this->beginPage() ?>
<?php require_once 'includes/_head.php'; ?>
<?php $this->beginBody() ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <?php require_once 'includes/_nav.php'; ?>
    <div class="content-wrapper">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <section class="content">
            <?= $content ?>
        </section>
    </div>
</div>
<?php require_once 'includes/_footer.php' ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>


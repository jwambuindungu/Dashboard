<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DASHBOARD_USERS */

$this->title = 'Create Dashboard  Users';
$this->params['breadcrumbs'][] = ['label' => 'Dashboard  Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dashboard--users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

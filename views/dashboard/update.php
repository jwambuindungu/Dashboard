<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DASHBOARD_USERS */

$this->title = 'Update Dashboard  Users: ' . $model->PAYROLL_NO;
$this->params['breadcrumbs'][] = ['label' => 'Dashboard  Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->PAYROLL_NO, 'url' => ['view', 'id' => $model->PAYROLL_NO]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dashboard--users-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

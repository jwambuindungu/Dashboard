<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DASHBOARD_USERS */

$this->title = $model->PAYROLL_NO;
$this->params['breadcrumbs'][] = ['label' => 'Dashboard  Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dashboard--users-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->PAYROLL_NO], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->PAYROLL_NO], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'PAYROLL_NO',
            'SURNAME',
            'OTHER_NAMES',
            'ACTIVE',
            'AUTH_KEY',
            'ACCESS_TOKEN',
        ],
    ]) ?>

</div>

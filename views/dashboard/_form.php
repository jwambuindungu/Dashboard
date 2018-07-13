<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DASHBOARD_USERS */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dashboard--users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'PAYROLL_NO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SURNAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OTHER_NAMES')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ACTIVE')->textInput() ?>

    <?= $form->field($model, 'AUTH_KEY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ACCESS_TOKEN')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>
<!--<div class="site-login col-md-8 col-md-offset-2" style="margin-top: 50px;">-->

<div class="login-box">
    <div class="login-logo">
        <div align="center">
            <img class="img-thumbnail" id="img_logo" width="130" src="<?= Yii::$app->homeUrl;?>images/new_uon_logo.png">
        </div>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <div align="center">
        <h3>Welcome to the University Management Dashboard</h3>
        </div>
        <p class="login-box-msg">LOGIN TO PROCEED</p>
        <?php $form = ActiveForm::begin(); ?>

            <div class="form-group has-feedback">
                <?= $form->field($model, 'username')
                    ->textInput(['autofocus' => true,'placeholder'=>'Payroll No.'])->label(false) ?>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <?= $form->field($model, 'password')
                    ->passwordInput(['placeholder'=>'Password'])->label(false) ?>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <?= Html::submitButton('Login',
                        ['class' => 'btn btn-success btn-lg btn-block', 'name' => 'login-button']) ?>
                </div>
                <div class="clearfix">&nbsp;</div>
                <div align="center" class="col-xs-12">
                    <h5>
                        Forgot your password?
                        <?= Html::a('Reset Password','//reset.uonbi.ac.ke',['target'=>'blank']);?>
                    </h5>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<style>
    .login-page{
        background-image: url('<?=Yii::$app->homeUrl;?>images/cover_uon.JPG');
        background-size:     cover;
        background-repeat:   no-repeat;
        background-position: center center;
    }
    .container{
        background:url('<?=Yii::$app->homeUrl;?>images/overlay-bg.png') repeat rgba(0,0,0,0.3);
        position:absolute;
        width:100%;
        height:100%;
        top:0;
        left:0;
        z-index:9;
    }
</style>

<?php
$script = <<< JS
$('body').addClass('login-page');
JS;
$this->registerJs($script, \yii\web\View::POS_READY);
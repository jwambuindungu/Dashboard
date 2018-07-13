<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Budgetary';

$this->params['breadcrumbs'][] = ['label' => 'Staff Reports', 'url' => ['//staff-reports']];
$this->params['breadcrumbs'][] = $this->title;


// $form = ActiveForm::begin(); //Default Active Form begin
$form = ActiveForm::begin([
    'id' => 'active-form',
    'options' => [
				'class' => 'form-horizontal text-center',
				'enctype' => 'multipart/form-data'
				],
	'method' => 'get',
	'action' => Url::to(['']),
]);
/* ADD FORM FIELDS */
echo '<div class="form-group"><div class="col-xs-4">';
echo Html::dropDownList('y', null,$yrList,['prompt'=>'Choose Year ~~','class'=>'form-control','onchange'=>'this.form.submit()']) ;
echo '</div></div>';

ActiveForm::end();

if(isset($_GET['C']) && !empty($_GET['C']))
	echo $this->render( '_cvbudget', $lvl2 ); 
else
	echo $this->render( '_cbudget', $lvl2 ); 

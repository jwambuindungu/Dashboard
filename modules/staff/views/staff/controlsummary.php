<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Salary - Control Summary';

$this->params['breadcrumbs'][] = ['label' => 'Finance - Staff', 'url' => ['//finance-reports']];
$this->params['breadcrumbs'][] = $this->title;


// $form = ActiveForm::begin(); //Default Active Form begin
$form = ActiveForm::begin([
    'id' => 'active-form',
    'options' => [
				'class' => 'form-horizontal',
				'enctype' => 'multipart/form-data'
				],
	'method' => 'get',
	'action' => Url::to(['']),
]);
/* ADD FORM FIELDS */
echo '<div class="form-group"><div class="col-xs-4">';
echo Html::dropDownList('prdcode', null,$periods,['prompt'=>'Choose Period ~~','class'=>'form-control','onchange'=>'this.form.submit()']) ;
echo '</div></div>';

ActiveForm::end();

// $lvl2['data']['graphdata']=$graphdata;

if(isset($_GET['T']) && !empty($_GET['T']))
	echo $this->render( '_csummaryind', $lvl2 ); 
else
	echo $this->render( '_csummary', $lvl2 ); 


?>

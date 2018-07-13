<?php
/* @var $this yii\web\View */

$stitle=$this->title = 'Staff on Leave';
$this->params['breadcrumbs'][] = ['label' => 'HR - Personnel', 'url' => ['//staff-reports']];
$this->params['breadcrumbs'][] = $stitle;

if(isset($_GET['C']) && !empty($_GET['C']))
	echo $this->render( '_staffOnLeaveD', $lvl2 );
else
	echo $this->render( '_staffOnLeave', $lvl2 );
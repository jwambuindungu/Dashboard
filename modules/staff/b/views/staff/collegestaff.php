<?php
/* @var $this yii\web\View */

// use yii\helpers\Url;
$stitle = 'Gender & Designation Report';

$this->params['breadcrumbs'][] = ['label' => 'Staff Reports', 'url' => ['//staff-reports']];
$this->params['breadcrumbs'][] = $stitle;

if(isset($_GET['C']) && !empty($_GET['C']))
	if(isset($_GET['G']) && !empty($_GET['G']))
		echo $this->render( '_collstaffgrade', ['data'=> $data,'grade'=> $grade,'colName'=> $colName,'tstat'=> $tstat] );
	else
		echo $this->render( '_collstaffdesig', ['data'=> $data,'colName'=> $colName,'tstat'=> $tstat] ); 
else
	echo $this->render( '_collstaff', ['sdata'=> $data ,'graphdata'=>$graphdata] ); 

?>

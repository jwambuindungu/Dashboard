<?php
/* @var $this yii\web\View */

$this->title = 'Staff Age Distribution';

if(isset($_GET['C']) && !empty($_GET['C']))
	echo $this->render( '_age_dbracket', $lvl2 ); 
else
	echo $this->render( '_age_cbracket', $lvl2 ); 
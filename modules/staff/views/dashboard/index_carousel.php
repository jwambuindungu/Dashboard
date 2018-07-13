<?php
/* @var $this yii\web\View */
/* @var $chartdata array */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $start_date string */
/* @var $end_date string */
/* @var $intake_name string */

use \yii\helpers\Url;
use \yii\helpers\Html;

\app\assetmanager\FusionChartAsset::register($this);

$this->title = 'Staff Datapool';

// $this->params['breadcrumbs'][] = $this->title;

?>


<div class="">
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  
	  <div class="small-box bg-aqua">
		<div class="inner">
		  <h3><?=$ts?></h3>

		  <p>Teaching Staff</p>
		</div>
	  </div>
	</div>
	
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  
	  <div class="small-box bg-aqua">
		<div class="inner">
		  <h3><?=$nts?></h3>

		  <p>Non-Teaching Staff</p>
		</div>
	  </div>
	</div>
	
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  
	  <div class="small-box bg-aqua">
		<div class="inner">
		  <h3><?=$retire?></h3>

		  <p>About to Retire</p>
		</div>
	  </div>
	</div>

 
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  
	  <div class="small-box bg-green">
		<div class="inner">
		  <h3><?=$active?></h3>
		  <p>Active</p>
		</div>
	  </div>
	</div>
	
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  
	  <div class="small-box bg-green">
		<div class="inner">
		  <h3><?=$contract?></h3>
		  <p>Contract</p>
		</div>
	  </div>
	</div>
	
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  
	  <div class="small-box bg-green">
		<div class="inner">
		  <h3><?=$leave?></h3>
		  <p>Other Leave</p>
		</div>
	  </div>
	</div>
	
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  
	  <div class="small-box bg-green">
		<div class="inner">
		  <h3><?=$second;?></h3>
		  <p>Seconded</p>
		</div>
	  </div>
	</div>
	
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  
	  <div class="small-box bg-green">
		<div class="inner">
		  <h3><?=$suspend;?></h3>
		  <p>Suspended</p>
		</div>
	  </div>
	</div>
	
	
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  
	  <div class="small-box bg-yellow">
		<div class="inner">
		  <h3><?=$permanent?></h3>

		  <p>Permanent</p>
		</div>
	  </div>
	</div>
	
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  
	  <div class="small-box bg-yellow">
		<div class="inner">
		  <h3><?=$temp?></h3>

		  <p>Temporary</p>
		</div>
	  </div>
	</div>
	
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  
	  <div class="small-box bg-yellow">
		<div class="inner">
		  <h3><?=$oncontract;?></h3>
		  <p>Contract</p>
		</div>
	  </div>
	</div>
	
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  
	  <div class="small-box bg-yellow">
		<div class="inner">
		  <h3><?=$postret;?></h3>
		  <p>Post Retirement</p>
		</div>
	  </div>
	</div>
	
</div>

<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
<!-- Add the slick-theme.css if you want default styling -->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick-theme.css"/>


<script>
// Carousel Auto-Cycle
  $(document).ready(function() {
    $('.carousel').carousel({
      interval: 2000
    })
  });

</script>
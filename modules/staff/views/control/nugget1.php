<?php
/* @var $this yii\web\View */
/* @var $chartdata array */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $start_date string */
/* @var $end_date string */
/* @var $intake_name string */

use \yii\helpers\Url;
use \yii\helpers\Html;

$this->title = 'Staff Nuggets';

?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" />

  <!-- Small boxes (Stat box)
<div class="row"> -->
<div class="slidit">
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-aqua">
		<div class="inner">
		  <h3><?=$ts?></h3>

		  <h4>Teaching Staff</h4>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-aqua">
		<div class="inner">
		  <h3><?=$nts?></h3>

		  <h4>Non-Teaching Staff</h4>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-aqua">
		<div class="inner">
		  <h3><?=$ps?></h3>

		  <h4>Project Staff</h4>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-aqua">
		<div class="inner">
		  <h3><?=$retire?></h3>

		  <h4>About to Retire</h4>
		</div>
	  </div>
	</div>
	<!-- ./col -->
<!-- </div>
/.row -->

  <!-- Small boxes (Stat box)
<div class="row"> -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-green">
		<div class="inner">
		  <h3><?=$active?></h3>
		  <h4>Active</h4>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-green">
		<div class="inner">
		  <h3><?=$contract?></h3>
		  <h4>Contract</h4>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-green">
		<div class="inner">
		  <h3><?=$sabb?></h3>
		  <h4>Sabbatical Leave</h4>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-green">
		<div class="inner">
		  <h3><?=$study?></h3>
		  <h4>Study Leave</h4>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-green">
		<div class="inner">
		  <h3><?=$leave?></h3>
		  <h4>Other Leave</h4>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-green">
		<div class="inner">
		  <h3><?=$second;?></h3>
		  <h4>Seconded</h4>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-green">
		<div class="inner">
		  <h3><?=$suspend;?></h3>
		  <h4>Suspended</h4>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-yellow">
		<div class="inner">
		  <h3><?=$permanent?></h3>

		  <h4>Permanent</h4>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-yellow">
		<div class="inner">
		  <h3><?=$temp?></h3>

		  <h4>Temporary</h4>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-yellow">
		<div class="inner">
		  <h3><?=$oncontract;?></h3>
		  <h4>Contract</h4>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-yellow">
		<div class="inner">
		  <h3><?=$postret;?></h3>
		  <h4>Post Retirement</h4>
		</div>
	  </div>
	</div>
	<!-- ./col -->
</div>

  <script type="text/javascript">
    $(document).ready(function(){
      $('.slidit').slick({
        slidesToShow: 5,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 3500,
		lazyLoad: 'ondemand',
		// variableWidth: true,
		dots: false,
		arrows: false,
		
		responsive: [
			{
			  breakpoint: 1024,
			  settings: {
				slidesToShow: 3,
				slidesToScroll: 1,
				infinite: true,
				dots: true
			  }
			},
			{
			  breakpoint: 600,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 2
			  }
			},
			{
			  breakpoint: 480,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			  }
			}
			// You can unslick at a given breakpoint now by adding:
			// settings: "unslick"
			// instead of a settings object
		]
      });
    });
  </script>
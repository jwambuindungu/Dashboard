<?php
/* @var $this yii\web\View */
/* @var $chartdata array */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $start_date string */
/* @var $end_date string */
/* @var $intake_name string */

?>

  <!-- Small boxes (Stat box)-->
<div class="slidit">

    <div class="text-center col-lg-2 col-md-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow-gradient">
            <div class="inner">
                <h3><?=number_format($permanent)?></h3>

                <h4>Permanent<br/>Staff</h4>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="text-center col-lg-2 col-md-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow-gradient">
            <div class="inner">
                <h3><?=number_format($temp+$oncontract+$postret)?></h3>

                <h4>Contract<br/>Staff</h4>
            </div>
        </div>
    </div>
    <!-- ./col -->
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-yellow-gradient">
		<div class="inner">
		  <h3><?=number_format($retire)?></h3>

		  <h4>Staff Retiring<br/>within an Year</h4>
		</div>
	  </div>
	</div>
	<!-- ./col -->
    <!-- ./col -->
    <div class="text-center col-lg-2 col-md-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green-gradient">
            <div class="inner">
                <h3><?=number_format($stud_tot)?></h3>

                <h4>Students Population<br/><?=$stud_yr?></h4>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <!-- ./col -->
    <div class="text-center col-lg-2 col-md-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green-gradient">
            <div class="inner">
                <h3>Kes <?=number_format($fee_today)?></h3>

                <h4>Fee Collected<br/>Today (Module II)</h4>
            </div>
        </div>
    </div>
    <!-- ./col -->
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-aqua">
		<div class="inner">
		  <h3><?=number_format($appraised,1)?>%</h3>

		  <h4>Staff Appraised<br/><?=$appraise_yr?></h4>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-blue-gradient">
		<div class="inner">
		  <h3><?=number_format($grants)?></h3>

		  <h4>Total Grants<br/><?=$grant_yr?></h4>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-blue-gradient">
		<div class="inner">
		  <h3><?=number_format($grants_collect)?></h3>

		  <h4>Collected Grants<br/><?=$grant_yr?></h4>
		</div>
	  </div>
	</div>
	<!-- ./col -->
<!-- </div>
/.row -->
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
				dots: false
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
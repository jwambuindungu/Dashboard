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

  <!-- Small boxes (Stat box)
<div class="row"> -->
<div class="">
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-aqua">
		<div class="inner">
		  <h3><?=$ts?></h3>

		  <p>Teaching Staff</p>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-aqua">
		<div class="inner">
		  <h3><?=$nts?></h3>

		  <p>Non-Teaching Staff</p>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-aqua">
		<div class="inner">
		  <h3><?=$retire?></h3>

		  <p>About to Retire</p>
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
		  <p>Active</p>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-green">
		<div class="inner">
		  <h3><?=$contract?></h3>
		  <p>Contract</p>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-green">
		<div class="inner">
		  <h3><?=$leave?></h3>
		  <p>Other Leave</p>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-green">
		<div class="inner">
		  <h3><?=$second;?></h3>
		  <p>Seconded</p>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-green">
		<div class="inner">
		  <h3><?=$suspend;?></h3>
		  <p>Suspended</p>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-yellow">
		<div class="inner">
		  <h3><?=$permanent?></h3>

		  <p>Permanent</p>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-yellow">
		<div class="inner">
		  <h3><?=$temp?></h3>

		  <p>Temporary</p>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-yellow">
		<div class="inner">
		  <h3><?=$oncontract;?></h3>
		  <p>Contract</p>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-yellow">
		<div class="inner">
		  <h3><?=$postret;?></h3>
		  <p>Post Retirement</p>
		</div>
	  </div>
	</div>
	<!-- ./col -->
</div>

  
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#staffpop-chart" data-toggle="tab">Graph</a></li>
              <li><a href="#staffpop-donut" data-toggle="tab">Donut</a></li>
              <li class="pull-left header"><i class="fa fa-users fa-fw"></i> Staff Population</li>
            </ul>
            <!-- <div class="tab-content no-padding"> -->
            <div class="tab-content">
              <!-- Fusion chart - Population -->
              <div class="chart tab-pane active" id="staffpop-chart" style="position: relative; height: 350px;"></div>
              <div class="chart tab-pane" id="staffpop-donut" style="position: relative; height: 350px;"></div>
            </div>
          </div>
          <!-- /.nav-tabs-custom -->

          <!-- Stats box -->
          <!-- <div class="box box-solid bg-teal-gradient"> -->
          <div class="box">
            <div class="box-header">
              <!-- tools box -->
              <div class="pull-right box-tools">
                <!-- <button type="button" class="btn bg-teal btn-sm daterange pull-right" data-toggle="tooltip" title="Date range">
                  <i class="fa fa-calendar"></i></button>-->
                <button type="button" class="btn bg-teal btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
                  <i class="fa fa-minus"></i></button>
              </div>
              <!-- /. tools -->

              <i class="fa fa-line-chart fa-fw"></i>

              <h3 class="box-title">
                Controll Summary
              </h3>
            </div>
            <div class="box-body">
              <div id="controlsum-chart" style="height: 350px; width: 100%;"></div>
            </div>
          </div>
          <!-- /.box -->
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-6 connectedSortable">

          <!-- Stats box -->
		  <!-- <div class="box box-solid bg-light-blue-gradient -->
          <div class="box">
            <div class="box-header">
              <!-- tools box -->
              <div class="pull-right box-tools">
                <!-- <button type="button" class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip" title="Date range">
                  <i class="fa fa-calendar"></i></button>-->
                <button type="button" class="btn btn-primary btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
                  <i class="fa fa-minus"></i></button>
              </div>
              <!-- /. tools -->

              <i class="fa fa-venus-mars fa-fw"></i>

              <h3 class="box-title">
                Gender Stats
              </h3>
            </div>
            <div class="box-body">
              <div id="gender-graph" style="height: 350px; width: 100%;"></div>
            </div>
          </div>
          <!-- /.box -->
          <div class="box">
            <div class="box-header">
              <!-- tools box -->
              <div class="pull-right box-tools">
                <!-- <button type="button" class="btn bg-teal btn-sm daterange pull-right" data-toggle="tooltip" title="Date range">
                  <i class="fa fa-calendar"></i></button>-->
                <button type="button" class="btn bg-teal btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
                  <i class="fa fa-minus"></i></button>
              </div>
              <!-- /. tools -->

              <i class="fa fa-graduation-cap fa-fw"></i>

              <h3 class="box-title">
                Professors
              </h3>
            </div>
            <div class="box-body">
              <div id="prof-donut" style="height: 350px; width: 100%;"></div>
            </div>
          </div>
          <!-- /.box -->


        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

	  
	  
<script>
$(function () {

  "use strict";
  
  //Make the dashboard widgets sortable Using jquery UI
	$(".connectedSortable").sortable({
		placeholder: "sort-highlight",
		connectWith: ".connectedSortable",
		handle: ".box-header, .nav-tabs",
		forcePlaceholderSize: true,
		zIndex: 999999
	});
	$(".connectedSortable .box-header, .connectedSortable .nav-tabs-custom").css("cursor", "move");
  
	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		$(this).delay(1000).queue(function() {
			$('[class$="-creditgroup"]').each(function() {
				$(this).css('display','none')
			});
			$(this).dequeue();
		});
	});
  
});
</script>
<script type="text/javascript">
    FusionCharts.ready(function(){
        var fs = new FusionCharts(<?=$colpopdata;?>);
		fs.render();
		
        fs = new FusionCharts(<?=$colpopdataD;?>);
		fs.render();
		
		fs = new FusionCharts(<?=$colgendata?>);
		fs.render();
		
		fs = new FusionCharts(<?=$ctrlsumdata;?>);
		fs.render();
		
		fs = new FusionCharts(<?=$profgendata;?>);
		fs.render();
		
		$(this).delay(1000).queue(function() {
			$('[class$="-creditgroup"]').each(function() {
				$(this).css('display','none')
			});
			$(this).dequeue();
		});
    });
</script>
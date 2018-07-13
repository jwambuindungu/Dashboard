<?php
/* @var $this yii\web\View */
/* @var $chartdata array */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $start_date string */
/* @var $end_date string */
/* @var $intake_name string */

use enscope\Yii2ChartJs\ChartJsWidget;
use \yii\helpers\Url;
use \yii\helpers\Html;

\app\assetmanager\FusionChartAsset::register($this);

$this->title = 'Staff Datapool';

// $this->params['breadcrumbs'][] = $this->title;

?>

  <!-- Small boxes (Stat box) -->
<div class="row">
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
	  <div class="small-box bg-green">
		<div class="inner">
		  <h3><?=$nts?></h3>

		  <p>Non-Teaching Staff</p>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-yellow">
		<div class="inner">
		  <h3><?=$st?></h3>

		  <p>About to Retire</p>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-red">
		<div class="inner">
		  <h3>65</h3>
		  <p>Suspended</p>
		</div>
	  </div>
	</div>
	<!-- ./col -->
</div>
<!-- /.row -->

  <!-- Small boxes (Stat box) -->
<div class="row">
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-aqua">
		<div class="inner">
		  <h3><?=$ts?></h3>
		  <p>Active</p>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-green">
		<div class="inner">
		  <h3><?=$nts?></h3>
		  <p>Contract</p>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-yellow">
		<div class="inner">
		  <h3><?=$st?></h3>
		  <p>Other Leave</p>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-red">
		<div class="inner">
		  <h3>65</h3>
		  <p>Seconded</p>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-red">
		<div class="inner">
		  <h3>65</h3>
		  <p>Suspended</p>
		</div>
	  </div>
	</div>
	<!-- ./col -->
</div>
<!-- /.row -->

  <!-- Small boxes (Stat box) -->
<div class="row">
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-aqua">
		<div class="inner">
		  <h3><?=$ts?></h3>

		  <p>Permanent</p>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-green">
		<div class="inner">
		  <h3><?=$nts?></h3>

		  <p>Temporary</p>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-yellow">
		<div class="inner">
		  <h3><?=$st?></h3>
		  <p>Contract</p>
		</div>
	  </div>
	</div>
	<!-- ./col -->
	<div class="text-center col-lg-2 col-md-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-red">
		<div class="inner">
		  <h3>65</h3>
		  <p>Post Retirement</p>
		</div>
	  </div>
	</div>
	<!-- ./col -->
</div>
<!-- /.row -->
  
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> STAFF POPULATION
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="row">
				
				
					<div class="col-md-6">
						<div class="panel panel-info">
							<div class="panel-heading">
								<i class="fa fa-venus-mars fa-fw"></i> Gender Distribution per College
							</div>
							<!-- /.panel-heading -->
							<div class="panel-body">
								<?= ChartJsWidget::widget([
									'chartType' => ChartJsWidget::CHART_BAR,
									'canvasOptions' => [
										'height' => 800
									],
									'chartOptions' => [
										'animation' => false,
										'bezierCurve' => false,
										'maintainAspectRatio' => false,
										'responsive' => true,
										'tooltips' => [
											'callbacks' => [
												'label' => ChartJsWidget::js('function (item) { return (item.yLabel); }')
											]
										],
										'legend' => [
											'display' => true,
											'position' => 'bottom'
										]
									],
									'chartData' => $chartdata
								]) ?>
							</div>
							<!-- /.panel-body -->
						</div>
						<!-- /.panel -->
						
					</div>
					<div class="col-md-6">
						<div class="panel panel-info">
							<div class="panel-heading">
								<i class="fa fa-users fa-fw"></i> Staff Population per College
							</div>
							<!-- /.panel-heading -->
							<div class="panel-body">
								<?= ChartJsWidget::widget([
									'chartType' => ChartJsWidget::CHART_PIE,
									'canvasOptions' => [
										'height' => 800
									],
									'chartOptions' => [
										'animation' => false,
										'bezierCurve' => false,
										'maintainAspectRatio' => false,
										'responsive' => true,
										'title' => [
											'display' => true,
											'text' => 'Legend',
											'position' => 'bottom'
										],
										'legend' => [
											'display' => true,
											'position' => 'bottom'
										]
									],
									'chartData' => $piedata
								]) ?>
							</div>
							<!-- /.panel-body -->
						</div>
						<!-- /.panel -->
					</div>
				
				
				</div>
				<!-- /.panel-STAFF POPULATION -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
	</div>
</div>


      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#staffpop-chart" data-toggle="tab">Area</a></li>
              <li><a href="#staffpop-donut" data-toggle="tab">Donut</a></li>
              <li class="pull-left header"><i class="fa fa-inbox"></i> Staff Population</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Fusion chart - Population -->
              <div class="chart tab-pane active" id="staffpop-chart" style="position: relative; height: 300px;"></div>
              <div class="chart tab-pane" id="staffpop-donut" style="position: relative; height: 300px;"></div>
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

          <!-- Map box -->
          <div class="box box-solid bg-light-blue-gradient">
            <div class="box-header">
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip" title="Date range">
                  <i class="fa fa-calendar"></i></button>
                <button type="button" class="btn btn-primary btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
                  <i class="fa fa-minus"></i></button>
              </div>
              <!-- /. tools -->

              <i class="fa fa-map-marker"></i>

              <h3 class="box-title">
                Visitors
              </h3>
            </div>
            <div class="box-body">
              <div id="world-map" style="height: 250px; width: 100%;"></div>
            </div>
            <!-- /.box-body-->
            <div class="box-footer no-border">
              <div class="row">
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <div id="sparkline-1"></div>
                  <div class="knob-label">Visitors</div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <div id="sparkline-2"></div>
                  <div class="knob-label">Online</div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center">
                  <div id="sparkline-3"></div>
                  <div class="knob-label">Exists</div>
                </div>
                <!-- ./col -->
              </div>
              <!-- /.row -->
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
        var fusioncharts = new FusionCharts({
                type: 'column2d',
                renderAt: 'staffpop-chart',
                width: '100%',
                height: '100%',
                dataFormat: 'json',
                dataSource: {
                    "chart": {
                        "caption": "Staff in Colleges",
                        //"subCaption": "Last year",
                        "xAxisName": "COLLEGE",
                        "yAxisName": "No. of Staff",
                        //"numberPrefix": "$",
                        "canvasBgAlpha": "0",
                        "bgColor": "#DDDDDD",
                        "bgAlpha": "50",
                        //"theme": "fint",
                        "exportEnabled": "1"
                    },

                    "data": [{
                        "label": "Central Admin",
                        "value": "244"
                    }, {
                        "label": "CAVS",
                        "value": "567"
                    }, {
                        "label": "CAE",
                        "value": "678"
                    },{
                        "label": "CHSS",
                        "value": "244"
                    }, {
                        "label": "CHS",
                        "value": "567"
                    }, {
                        "label": "CEES",
                        "value": "678"
                    }, {
                        "label": "SWA",
                        "value": "678"
                    },]
                }
            }
        );
        fusioncharts.render();
		
        revenueChart = new FusionCharts({
			type: 'doughnut3d',
			renderAt: 'staffpop-donut',
			width: '100%',
			height: '100%',
			dataFormat: 'json',
			dataSource: {
            "chart": {
                "caption": "Split of Revenue by Product Categories",
                "subCaption": "Last year",
                "numberPrefix": "$",
                "paletteColors": "#0075c2,#1aaf5d,#f2c500,#f45b00,#8e0000",
				"exportEnabled": "1",
                "bgColor": "#ffffff",
                "showBorder": "0",
                "use3DLighting": "0",
                "showShadow": "0",
                "enableSmartLabels": "0",
                "startingAngle": "310",
                "showLabels": "0",
                "showPercentValues": "1",
                "showLegend": "1",
                "legendShadow": "0",
                "legendBorderAlpha": "0",                                
                "decimals": "0",
                "captionFontSize": "14",
                "subcaptionFontSize": "14",
                "subcaptionFontBold": "0",
                "toolTipColor": "#ffffff",
                "toolTipBorderThickness": "0",
                "toolTipBgColor": "#000000",
                "toolTipBgAlpha": "80",
                "toolTipBorderRadius": "2",
                "toolTipPadding": "5",
            },
            "data": [{
                        "label": "Central Admin",
                        "value": "244"
                    }, {
                        "label": "CAVS",
                        "value": "567"
                    }, {
                        "label": "CAE",
                        "value": "678"
                    },{
                        "label": "CHSS",
                        "value": "244"
                    }, {
                        "label": "CHS",
                        "value": "567"
                    }, {
                        "label": "CEES",
                        "value": "678"
                    }, {
                        "label": "SWA",
                        "value": "678"
                    }
            ]}
		}).render();

		
		$(this).delay(1000).queue(function() {
			$('[class$="-creditgroup"]').each(function() {
				$(this).css('display','none')
			});
			$(this).dequeue();
		});
    });
</script>
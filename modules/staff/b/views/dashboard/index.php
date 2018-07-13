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


// $dt = \app\modules\staff\models\USPAS::GET_APPRAISED_STAFF();
$dt = \app\modules\staff\models\DATA::BUILD_CS();

// $this->params['breadcrumbs'][] = $this->title;

?>

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
		  
          </div>
          <!-- /.nav-tabs-custom -->

          <!-- Stats box -->
          <!-- <div class="box box-solid bg-teal-gradient"> -->
          <?= $this->render('@app/modules/staff/views/control/ctrlsum_graph', ['ctrlsumdata' => json_encode($dt['graph'])]); ?>
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
    // FusionCharts.ready(function(){
        // var fs = new FusionCharts(<?=$colpopdata;?>);
		// fs.render();
		
        // fs = new FusionCharts(<?=$colpopdataD;?>);
		// fs.render();
		
		// fs = new FusionCharts(<?=$colgendata?>);
		// fs.render();
		
		// fs = new FusionCharts(<?=$ctrlsumdata;?>);
		// fs.render();
		
		// fs = new FusionCharts(<?=$profgendata;?>);
		// fs.render();
		
		// $(this).delay(1000).queue(function() {
			// $('[class$="-creditgroup"]').each(function() {
				// $(this).css('display','none')
			// });
			// $(this).dequeue();
		// });
    // });
</script>
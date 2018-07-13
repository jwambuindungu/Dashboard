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

$this->title = 'Finance';

// $this->params['breadcrumbs'][] = $this->title;

$dt = \app\modules\staff\models\DATA::BUILD_CS();

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

		  <p>Project Staff</p>
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
</div>

  
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-6 connectedSortable">
          <!-- Stats box -->
          <?= $this->render('@app/modules/staff/views/control/ctrlsum_graph', ['ctrlsumdata' => json_encode($dt['graph'])]); ?>
          <!-- /.box -->
        </section>
        <!-- /.Left col -->
        <!-- Right col -->
        <section class="col-lg-6 connectedSortable">
          <!-- Stats box -->
          
          <!-- /.box -->
        </section>
        <!-- /.Right col -->
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
  
});
</script>
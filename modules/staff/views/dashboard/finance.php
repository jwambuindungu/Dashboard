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

?>

    <!-- Nugget row -->
    <div align="center" class="row lug dtTupple">
        <i class="fa fa-refresh fa-spin text-info" style="font-size:50px"></i>
    </div>
    <!-- Main row -->
    <div align="center" class="row">
        <section class="col-lg-12 connectedSortable set1 dtTupple">
            <i class="fa fa-refresh fa-spin text-info" style="font-size:254px"></i>
        </section>
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
<?php
$rGu = Url::to(['/staff/control/controlsummarygraph-ajax']);
$rNu = Url::to(['/staff/control/staffnuggets-ajax']);
$script = <<< JS

$.get('$rNu', function(d){ $('.lug').html(d);});
$.get('$rGu', function(d){ $('.set1').html(d);});


JS;
$this->registerJs($script, \yii\web\View::POS_READY);
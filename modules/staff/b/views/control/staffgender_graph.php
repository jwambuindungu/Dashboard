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
<!-- Main row -->
<div class="row">
	<div class="col-lg-12">
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
				<h3 class="box-title">Staff Population</h3>
            </div>
            <div class="box-body">
				<div id="gender-graph" style="height: 70vh; width: 100%;"></div>
            </div>
		</div>
	</div>
</div>
<!-- /.row (main row) -->

<script type="text/javascript">
    FusionCharts.ready(function(){
        var fs = new FusionCharts(<?=$colgendata;?>);
		fs.render();
		
		$(this).delay(1000).queue(function() {
			$('[class$="-creditgroup"]').each(function() {
				$(this).css('display','none')
			});
			$(this).dequeue();
		});
    });
</script>
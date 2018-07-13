<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\staff\models\DATA;

\app\assetmanager\FusionChartAsset::register($this);

$colcode = [];
$nuData = [];
foreach($data as $v):
	$colcode[$v['COLLEGE']]=$v['COL_CODE'];
	unset($v['COL_CODE']);
	$nuData[]=$v;
endforeach;
$data = $nuData;
?>
<div class="box box-primary text-center">
	<div class="box-header with-border">
		<h4 class="box-title text-center">STAFF AGE DISTRIBUTION IN COLLEGES</h4>
		<?php if(count($data)): ?>
		<!-- tools box -->
		<div class="pull-right box-tools">
            <button class="btn btn-default pull-right pulse-btn" type="button" data-toggle="modal" data-target="#chart-modal" style="margin-right: 5px;"><i class="fa fa-line-chart"></i> View Graph</button>
		</div>
		<!-- /. tools -->
		<?php endif; ?>
	</div>

	<div class="box-body">
	<?php if(count($data)): ?>
	<!-- <button class="btn btn-info" type="button" data-toggle="modal" data-target="#chart-modal">View Chart<button> -->
	<table class="table table-bordered table-hover table-striped">
		<thead>
			<tr class="text-primary">
			<?php
			$headers = array_keys($data[0]);
			foreach($headers as $r):
				if($r=='COLLEGE')
					echo '<th class="text-left">'.$r.'</th>';
				else
					echo '<th class="text-center">'.str_replace('_',' ',$r).'</th>';
			endforeach;
			?>
			</tr>
		</thead>
		<tbody>
		<?php
		$res = $data;
		$t=[''];
		foreach($res as $k){
			echo '<tr>';
			foreach($headers as $r){
				$e='<td class="text-right">'.$k[$r].'</td>';
				if(is_numeric($k[$r]))
					$e='<td class="text-right">'.number_format($k[$r]).'</td>';
				if($r=='TOTAL'){
					$e='<th class="text-right">'.number_format($k[$r]).'</th>';
				}
				if($r=='COLLEGE'){
					$t['C']=$colcode[$k[$r]];
					$e='<th class="text-left"><a href="'.Url::to($t).'" class="btn btn-link btn-sm">'.DATA::ABBR_CNAME($k[$r]).'</th>';
				}
				echo $e;
			}
			echo '</tr>';
		}
		?>
		</tbody>
		<tfoot>
			<tr>
				<th>TOTAL</th>
				<?php
				$res = $dataT;
				$t=[''];
				foreach($res as $k){
					$e='<th class="text-right">'.number_format($k).'</th>';
					echo $e;
				}
				?>
			</tr>
		</tfoot>
	</table>
	<?php else: ?>
		<div class="alert alert-warning alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			No Data Found for <?=$y;?>
		</div>
	<?php endif; ?>
	</div>
</div>



<div>
<div id="chart-modal" class="modal">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-body">
		<div id="colstaffage-chart" style="height: 70vh; width: 100%;"></div>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
	  </div>
	</div>
	<!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</div>
<!-- /.example-modal -->


<script type="text/javascript">

	$(function () {

		"use strict";
	  
		$(document).on('shown.bs.modal', function (e) {
			$(this).delay(500).queue(function() {
				$('[class$="-creditgroup"]').each(function() {
					$(this).css('display','none')
				});
				$(this).dequeue();
			});
		});
	  
	});
    FusionCharts.ready(function(){
        var fs = new FusionCharts(<?=$graphdata;?>);
		fs.render();
    });
</script>
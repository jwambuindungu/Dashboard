<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
\app\assetmanager\FusionChartAsset::register($this);

?>


<div class="box box-primary text-center">
	<div class="box-header with-border">
		<h4 class="box-title text-center">CONTROL SUMMARY COMPARISON, <?=$prdTit?></h4>
		<?php if(count($data)): ?>
		<!-- tools box -->
		<div class="pull-right box-tools">
			<button class="btn btn-default btn-sm pull-right" type="button" data-toggle="modal" data-target="#chart-modal" style="margin-right: 5px;"><i class="fa fa-line-chart"></i></button>
		</div>
		<!-- /. tools -->
		<?php endif; ?>
	</div>

	<div class="box-body">
	<table class="table table-bordered table-hover table-striped table-nonfluid">
		<thead class="text-primary">
		<tr>
			<th class="text-left col-lg-3">TRANSACTION</th>
			<th class="text-right"><?=$titP[0];?></th>
			<th class="text-right"><?=$titP[1];?></th>
			<th class="text-right"><?=$titP[2];?></th>
		</tr>
		</thead>
		<tbody>
		<?php
		$res = $data;
		$newOptions = array();
		foreach ($res as $option) {
			$tt = ((int)$option['TRAN_CODE']==890)?'DEDUCTIONS':'';
			$tt = (empty($tt))?((int)$option['TRAN_CODE']==800)?'EARNINGS':$tt:$tt;
			
			$newOptions[$option['REPORT_TITLE']][] = array(
				'TT' => $tt,
				'TRAN_CODE' => $option['TRAN_CODE'],
				'TRAN_NAME' => $option['TRAN_NAME'],
				'PREV1' => $option['PREV1'],
				'PREV2' => $option['PREV2'],
				'CURR' => $option['CURR'],
			);
		}
		$pointer=array_keys($newOptions);
		?>
		<?php
		foreach($newOptions['SUMMARY'] as $sumr){
			if(in_array($sumr["TRAN_CODE"],[800,900,890])):
			?>
			<tr>
				<th width="300"><?=($sumr["TRAN_CODE"]=='900')?$sumr["TRAN_NAME"]:'<a class="btn btn-link btn-xs" href="?T='.$sumr["TT"].'&prdcode='.urlencode($prdcode).'">'.$sumr["TRAN_NAME"].'</a>';?></th>
				<td width="100" align= "Right"> <?= number_format($sumr["PREV2"], 2) ?></td>
				<td width="100" align= "Right"> <?= number_format($sumr["PREV1"], 2) ?></td>
				<td width="100" align= "Right"> <?= number_format($sumr["CURR"], 2) ?></td>
			</tr>
			<?php
			endif;
		}
		
		unset($newOptions['SUMMARY']);
		
		if(($key = array_search("SUMMARY", $pointer)) !== false) {
			unset($pointer[$key]);
		}
		?>
		</tbody>
	</table>
	</div>
</div>

<div>
<div id="chart-modal" class="modal">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-body">
		<div id="controlsum-chart" style="height: 70vh; width: 100%;"></div>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
	  </div>
	</div>
	<!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</div>
<!-- /.example-modal -->

<style>
/**/
.table-nonfluid {
   width: auto !important;
   margin: 0 auto;
}
</style>

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
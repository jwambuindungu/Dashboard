<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use app\modules\staff\models\DATA;

\app\assetmanager\FusionChartAsset::register($this);
?>
<div class="box box-primary text-center">
	<div class="box-header with-border">
		<h4 class="box-title text-center">STAFF IN COLLEGES BY CATEGORY</h4>
		<?php if(count($sdata)): ?>
		<!-- tools box -->
		<div class="pull-right box-tools">
			<button class="btn btn-default btn-sm pull-right" type="button" data-toggle="modal" data-target="#chart-modal" style="margin-right: 5px;"><i class="fa fa-line-chart"></i></button>
		</div>
		<!-- /. tools -->
		<?php endif; ?>
	</div>

	<div class="box-body text-center">
	<table class="table table-bordered table-hover table-striped table-nonfluid">
		<thead>
			<tr class="text-primary">
				<th>COLLEGE</th>
				<th class="text-center">TEACHING STAFF</th>
				<th class="text-center">NON-TEACHING STAFF</th>
				<th class="text-center">PROJECT STAFF</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$res = $sdata;
		$sumM = 0;
		$sumT = 0;
		$sumNT = 0;
		$sumP = 0;
		foreach($res as $k){
			$sumT+= $k["TS"];
			$sumNT+= $k["NTS"];
			$sumP+= $k["P"];
			// $sumM+= $sumNT+$sumT;
			?>
			<tr style="font-weight: bold;">
				<td nowrap class="text-left"><?= DATA::ABBR_CNAME($k["COL_NAME"]) ?></td>
				<td nowrap class="text-right"> <?= $k["TS"]?'<a href="'.Url::to(['', 'C' => $k["COL_CODE"], 'T' => 'T']).'">'.$k["TS"].'</a>':'<span style="color:red;">0</span>' ?></td>
				<td nowrap class="text-right"> <?= $k["NTS"]?'<a href="'.Url::to(['', 'C' => $k["COL_CODE"]]).'">'.$k["NTS"].'</a>':'<span style="color:red;">0</span>' ?></td>
				<td nowrap class="text-right"> <?= $k["P"]?'<a href="'.Url::to(['', 'C' => $k["COL_CODE"], 'T' => 'P']).'">'.$k["P"].'</a>':'<span style="color:red;">0</span>' ?></td>
			</tr>
			<?php
		}
		?>
		</tbody>
		<tfoot>
			<tr>
				<th class="text-primary">TOTAL</th>
				<th class="text-right"><?=$sumT?></th>
				<th class="text-right"><?=$sumNT?></th>
				<th class="text-right"><?=$sumP?></th>
			</tr>
			<tr>
				<th class="text-primary" colspan=3>GRAND TOTAL</th>
				<th class="text-right"><?=($sumNT+$sumT+$sumP)?></th>
			</tr>
		</tfoot>
	</table>
	</div>
</div>

<div>
<div id="chart-modal" class="modal">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-body">
		<div id="colstaffcat-chart" style="height: 70vh; width: 100%;"></div>
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
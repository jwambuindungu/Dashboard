<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
?>

<div class="box box-primary text-center">
	<div class="box-header with-border">
		<h4 class="box-title text-center">CONTROL SUMMARY COMPARISON FOR <?=$_GET['T'];?>, <?=$titP[2]?></h4>
		<h6 class="text-center"><a class="btn btn-xs btn-primary" href="<?= Url::to(['','prdcode'=>$prdcode]);?>"><i class="fa fa-angle-left"></i> Back</a></h6>
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
		
		$_POST = array();
		$key=$_GET['T'];
		?>
		<!-- 
		<tr> 
		  <td>&nbsp;</td>
		  <th width="150" class="text-left" style="border-left-style: hidden;" colspan=3><?=$key;?></th>
		</tr>
		-->
		<?php
		foreach($newOptions[$key] as $sumr){
			?>
			<tr>
				<th width="300" class="text-left" ><?= $sumr["TRAN_NAME"] ?></th>
				<td width="100" class="text-right"><?= number_format($sumr["PREV2"], 2) ?></td>
				<td width="100" class="text-right"><?= number_format($sumr["PREV1"], 2) ?></td>
				<td width="100" class="text-right"><?= number_format($sumr["CURR"], 2) ?></td>
			</tr>
			<?php
		}
		
		foreach($newOptions['SUMMARY'] as $sumr){
			if($sumr["TT"]==$key):
			?>
			<tr class="text-primary">
				<th class="text-left" width="300"><?=$sumr["TRAN_NAME"];?> (TOTAL)</th>
				<th class="text-right" width="100"><?= number_format($sumr["PREV2"], 2) ?></th>
				<th class="text-right" width="100"><?= number_format($sumr["PREV1"], 2) ?></th>
				<th class="text-right" width="100"><?= number_format($sumr["CURR"], 2) ?></th>
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

<style>
/**/
.table-nonfluid {
   width: auto !important;
   margin: 0 auto;
}
</style>

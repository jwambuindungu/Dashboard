<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
// yii\helpers\Url

// $this->params['breadcrumbs'][] = $this->title;
?>

<div class="box box-primary text-center">
	<div class="box-header with-border">
		<h4 class="text-center"><strong><?=$colName;?> <?=$tstat?> COUNT BASED ON GRADE & GENDER</strong></h4>
		<h6 class="text-center"><a class="btn btn-xs btn-primary" href="<?= Url::to(['']);?>"><i class="fa fa-angle-left"></i> Back</a></h6>
	</div>

	<div class="box-body">
	<table class="table table-bordered table-hover table-striped table-nonfluid">
		<thead>
			<tr>
				<th>GRADE</th>
				<th>MALE</th>
				<th>FEMALE</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$res = $data;
		$t=[''];
		if(isset($_GET['T']))
			$t['T'] = $_GET['T'];
		$sumMl = 0;
		$sumFMl = 0;
		foreach($res as $k){
			$sumMl+= $k["MALE"];
			$sumFMl+= $k["FEMALE"];
			$bc="";
			$t['C']=$k["COL_CODE"];
			$t['G']=$k["GRADE_CODE"];
		?>
			<tr style="font-weight: bold;<?=$bc?>">
<!--				<td class="text-left"><a href="--><?//=Url::to($t);?><!--">--><?//= $k["GRADE_NAME"] ?><!--</a></td>-->
				<td class="text-left"><?= $k["GRADE_NAME"] ?></td>
				<td class="text-right"> <?= $k["MALE"]?number_format($k["MALE"]):'<span style="color:red;">0</span>' ?></td>
				<td class="text-right"> <?= $k["FEMALE"]?number_format($k["FEMALE"]):'<span style="color:red;">0</span>' ?></td>
			</tr>
			<?php
		}
		?>
		</tbody>
		<tfoot>
			<tr>
			<th class="text-center text-primary">TOTAL</th>
			<th class="text-right"><?=number_format($sumMl)?></th>
			<th class="text-right"><?=number_format($sumFMl)?></th>
			</tr>
			<tr>
			<th class="text-center text-primary">GRAND TOTAL</th>
			<th class="text-right" colspan=2><?=number_format($sumMl+$sumFMl)?></th>
			</tr>
		</tfoot>
	</table>
	</div>
</div>

<style>
/**/
.table-nonfluid {
   width: auto !important;
   margin: 0 auto;
}
/*
.table-bordered td, .table-bordered th{
    border-color: black !important;
}
*/
</style>
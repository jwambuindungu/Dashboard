<?php
/* @var $this yii\web\View */

use yii\helpers\Url;

?>


<div class="box box-primary text-center">
	<div class="box-header with-border">
		<h4 class="text-center"><?=$colName;?> <?=$tstat?> IN <text class="text-primary"><?=$grade;?></text> GRADE</h4>
		<h6 class="text-center"><a class="btn btn-xs btn-primary" href="<?=Yii::$app->request->referrer?>"><i class="fa fa-angle-left"></i> Back</a></h6>
	</div>

	<div class="box-body">
	<table class="table table-bordered table-hover table-striped table-nonfluid">
		<thead>
			<tr>
				<th>PAYROLL No.</th>
				<th>NAME</th>
				<th>GENDER</th>
				<th>DESIGNATION</th>
			</tr>
		</thead>
		<tbody>
			<?php
		$res = $data;
		$sumMl = 0;
		$sumFMl = 0;
		foreach($res as $k){
			// $sumMl+= $k["MALE"];
			// $sumFMl+= $k["FEMALE"];
			$bc="";
			// if($bc!='')
				// $bc="";
			// else
				// $bc = ' background-color: #d3d3d3;';
			?>
			<tr style="font-weight: bold;<?=$bc?>">
				<td nowrap align="left"><?=$k["PAYROLL_NO"];?></td>
				<td nowrap align="left"><?=$k["NAME"];?></td>
				<td nowrap align="left"><?=$k["SEX"];?></td>
				<td nowrap align="left"><?=$k["DSG_NAME"];?></td>
			</tr>
			<?php
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
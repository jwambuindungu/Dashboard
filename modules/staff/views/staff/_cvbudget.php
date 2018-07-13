<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Budgetary';

?>
<div class="box box-primary">
	<div class="box-header with-border text-center">
		<h4 class="box-title text-center"><?=$colName?> BUDGET FOR <?=($y-1).'/'.$y?></h4>
		<h6 class="text-center"><a class="btn btn-xs btn-primary" href="<?=Yii::$app->request->referrer?>"><i class="fa fa-angle-left"></i> Back</a></h6>
	</div>

	<div class="box-body">
	<?php if(count($data)): ?>
	<table class="table table-bordered table-hover table-striped">
		<thead>
			<tr class="text-primary">
				<th>VOTE CODE</th>
				<th class="text-left">VOTE NAME</th>
				<th class="text-center">ALLOCATION</th>
				<th class="text-center">EXPENDITURE</th>
				<th class="text-center">BALANCE</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$res = $data;
		$sumM = 0;
		$sumT = 0;
		$sumNT = 0;
		foreach($res as $k){
			$sumT+= $k["ALLOCATION"];
			$sumNT+= $k["EXPENDITURE"];
			$sumM+= $sumT-$sumNT;
			?>
			<tr>
				<th nowrap class="text-left"><?= $k["VOTE_CODE"] ?></th>
				<th nowrap class="text-left"><?= $k["VOTE_NAME"] ?></th>
				<td nowrap class="text-right"><?= number_format($k["ALLOCATION"],2) ?></td>
				<td nowrap class="text-right"><?= number_format($k["EXPENDITURE"],2) ?></td>
				<td nowrap class="text-right"><?= number_format($k["ALLOCATION"]-$k["EXPENDITURE"],2) ?></td>
			</tr>
			<?php
		}
		?>
		</tbody>
		<tfoot>
			<tr>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
			<tr>
				<th colspan=2>TOTAL</th>
				<th class="text-right"><?= number_format($sumT,2)?></th>
				<th class="text-right"><?= number_format($sumNT,2)?></th>
				<th class="text-right"><?= number_format($sumT-$sumNT,2)?></th>
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

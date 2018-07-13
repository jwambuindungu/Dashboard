<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Budgetary';

?>
<div class="box box-primary text-center">
	<div class="box-header with-border">
		<h4 class="box-title text-center">UNIVERSITY CONSOLIDATED BUDGET FOR <?=$y?></h4>
	</div>

	<div class="box-body">
	<?php if(count($data)): ?>
	<table class="table table-bordered table-hover table-striped">
		<thead>
			<tr class="text-primary">
				<th>COLLEGE</th>
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
		$t=[''];
		foreach($res as $k){
			$sumT+= $k["ALLOCATION"];
			$sumNT+= $k["EXPENDITURE"];
			// $sumM+= $sumT-$sumNT;
			$t['C']=$k["COL_CODE"];
			$t['y']=$y;
			$bc="";
			?>
			<tr>
				<th nowrap class="text-left"><a href="<?=Url::to($t);?>"><?= $k["COL_NAME"] ?></a></th>
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
				<th class="text-right"></th>
				<th class="text-right"></th>
				<th class="text-right"></th>
			</tr>
			<tr>
				<th>TOTAL</th>
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

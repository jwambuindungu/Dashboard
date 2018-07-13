<?php
/* @var $this yii\web\View */
ini_set('display_errors',1);
use yii\helpers\Url;
// yii\helpers\Url

// print_r($data);exit;
?>
<h4 class="text-center">UNIVERSITY STAFF COUNT BASED ON GRADE & GENDER</h4>

<p>
<div class="table-responsive">
	<table class="table table-bordered table-hover table-striped">
		<thead>
			<tr>
				<th>COLLEGE</th>
				<th>TYPE</th>
				<th>No. OF STAFF</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$res = $sdata;
		$sumM = 0;
		foreach($res as $k){
			$sumM+= $k["NTS"]+$k["TS"];
			$bc="";
			?>
			<tr style="font-weight: bold;<?=$bc?>">
				<td nowrap rowspan=2><?= $k["COL_NAME"] ?></td>
				<td nowrap class=""><a href="<?= Url::to(['', 'C' => $k["COL_CODE"], 'T' => 'T']);?>">TEACHING STAFF</a></td>
				<td nowrap class="text-right"> <?= $k["TS"]?$k["TS"]:'<span style="color:red;">0</span>' ?></td>
			</tr>
			<tr style="font-weight: bold;<?=$bc?>">
				<td nowrap class="" align= "left"><a href="<?= Url::to(['', 'C' => $k["COL_CODE"]]);?>">NON-TEACHING STAFF</a></td>
				<td nowrap class="text-right"> <?= $k["NTS"]?$k["NTS"]:'<span style="color:red;">0</span>' ?></td>
			</tr>
			<?php
		}
		?>
		</tbody>
		<tfoot>
			<tr>
			<th colspan=2>TOTAL</th>
			<th class="text-right"><?=$sumM?></th>
			</tr>
		</tfoot>
	</table>
	</div>
</p>

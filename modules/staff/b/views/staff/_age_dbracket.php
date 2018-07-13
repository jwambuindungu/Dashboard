<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\staff\models\DATA;

// $this->title = 'Staff Position Status';

?>
<div class="box box-primary text-center">
	<div class="box-header with-border">
		<h4 class="box-title text-center">STAFF AGE DISTRIBUTION FOR <?=DATA::ABBR_CNAME($colName);?> DEPARTMENTS</h4>
		<h6 class="text-center"><a class="btn btn-xs btn-primary" href="<?=Yii::$app->request->referrer?>"><i class="fa fa-angle-left"></i> Back</a></h6>
	</div>

	<div class="box-body">
	<?php if(count($data)): ?>
	<table class="table table-bordered table-hover table-striped">
		<thead>
			<tr class="text-primary">
			<?php
			$headers = array_keys($data[0]);
			foreach($headers as $r):
				if($r=='DEPARTMENT')
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
		$sumM = 0;
		$sumT = 0;
		$sumNT = 0;
		$t=[''];
		foreach($res as $k){
			echo '<tr>';
			foreach($headers as $r){
				$e=$e='<td class="text-right">'.$k[$r].'</td>';
				if($r=='TOTAL'){
					$e='<th class="text-right">'.$k[$r].'</th>';
				}
				if($r=='DEPARTMENT')
					$e='<td class="text-left text-primary">'.$k[$r].'</td>';
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
					$e='<th class="text-right">'.$k.'</th>';
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

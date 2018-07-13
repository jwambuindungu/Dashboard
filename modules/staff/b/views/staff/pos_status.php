<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Staff Position Status';

?>
<div class="box box-primary text-center">
	<div class="box-header with-border">
		<h4 class="box-title text-center">STAFF COUNT BASED ON POSITION STATUS</h4>
	</div>

	<div class="box-body">
	<?php if(count($data)): ?>
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
		foreach($res as $k){
			echo '<tr>';
			foreach($headers as $r){
				$e=$e='<td class="text-right">'.$k[$r].'</td>';
				if($r=='COLLEGE')
					$e='<th class="text-left">'.$k[$r].'</th>';
				echo $e;
			}
			echo '</tr>';
		}
		?>
		</tbody>
	</table>
	<?php else: ?>
		<div class="alert alert-warning alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			No Data Found for <?=$y;?>
		</div>
	<?php endif; ?>
	</div>
</div>

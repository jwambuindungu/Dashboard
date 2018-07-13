<?php
/* @var $this yii\web\View */

use app\modules\staff\models\DATA;

// $this->title = 'Staff Position Status';

?>
<div class="box box-primary text-center">
	<div class="box-header with-border">
		<h4 class="box-title text-center">STAFF ON LEAVE FOR DEPARTMENTS IN <?=DATA::ABBR_CNAME($colName);?></h4>
		<h6 class="text-center"><a class="btn btn-xs btn-primary" href="<?=Yii::$app->request->referrer?>"><i class="fa fa-angle-left"></i> Back</a></h6>
	</div>

    <div class="box-body">
        <?php if(count($data)): ?>
            <!-- <button class="btn btn-info" type="button" data-toggle="modal" data-target="#chart-modal">View Chart<button> -->
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr class="text-primary">
                    <th>DEPARTMENT</th>
                    <th>TOTAL</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $tl=0;
                foreach($data as $k){
                    echo '<tr>';
                    $e='<td class="text-left">'.$k['DEPT_NAME'].'</td>';
                    $e.='<td class="text-right">'.number_format($k['TOTAL']).'</td>';
                    echo $e;
                    echo '</tr>';
                    $tl=$tl+$k['TOTAL'];
                }
                ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>TOTAL</th>
                    <th class="text-right"><?=number_format($tl)?></th>
                </tr>
                </tfoot>
            </table>
        <?php else: ?>
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                No Data Found!
            </div>
        <?php endif; ?>
    </div>
</div>

<?php

use \app\modules\uspas\models\USPAS;

/* @var $this yii\web\View */
$dt = USPAS::GET_APPRAISED_STAFF();
$dt2 = USPAS::GET_APPRAISED_STAFFOVERAL();
$uspas_data = USPAS::GET_APPRAISED_STAFF();

$y = USPAS::APPRAISAL_YEARLIST();
$yr = $y[0]['yr'];

$duration = '-5';
$interval = \app\components\DATA_INTERVAL::MONTH_INTERVAL;
$intke_chart_data = \app\modules\student\models\APPLICATIONS::BUILD_CHART_DATA($duration, $interval);//GET_SUPERVISOR_PENDING();
$intake_date_obj = \app\modules\student\models\APPLICATIONS::$date_range_obj;
?>

<!-- Nugget row -->
<div align="center" class="row lug dtTupple">
    <i class="fa fa-refresh fa-spin text-info" style="font-size:50px"></i>
</div>

<!-- /.row -->
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> % of College Staff with complete Supervisor Evaluation for the year <?=$yr?>
            </div>
            <div class="panel-body">
                <?= $this->render('@app/modules/uspas/views/uspas/collegeappraisalstatus', ['data' => $uspas_data,'yr'=>$yr,'range'=>0]); ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-users fa-fw"></i> Student Intake Statistics between <?= $intake_date_obj->START_DATE ?>
                and <?= $intake_date_obj->END_DATE ?>
            </div>
            <div class="panel-body">
                <?= $this->render('@app/modules/student/views/student/_intake-chart', ['date_obj' => $intake_date_obj, 'chartdata' => $intke_chart_data]); ?>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->

<?php
$rNu = \yii\helpers\Url::to(['/staff/control/dashnuggets-ajax']);
$script = <<< JS

$.get('$rNu', function(d){ $('.lug').html(d);})
    .fail(function(XMLHttpRequest, textStatus, errorThrown){ 
        $('.lug').html('<h4 class="text-danger">Error:' + XMLHttpRequest.status + 
         '<br/>Could not Display Nuggets</h4>');
    });
JS;
$this->registerJs($script, \yii\web\View::POS_READY);
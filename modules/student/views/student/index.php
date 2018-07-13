<?php
/* @var $this yii\web\View */
/* @var $chartdata array */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $date_obj string */

$this->params['breadcrumbs'][] = $this->title;

$currency = 'KES';
$ac_year = '2017/2018';
//$fees_collected = 890000;
$fees_collected = \app\modules\student\models\FEE_REPORT_MODEL::COLLEGE_SUMMARY_COLLECTIONS();
$application_fees_collected = \app\modules\student\models\APPLICATION_FEE_MODEL::COLLEGE_APPLICATION_FEES($currency);

$nominal_data = \app\modules\student\models\NOMINAL_ROLL_MODEL::NOMINAL_AC_YEAR_DATA_TABLE(true);


$total_population = 0;
$registered_students = 0;
$applications = 0;
$student_suspended = 20;
$students_id_application = 250;
$student_caution_refund = 129;
$students_discontinued = 0;


foreach ($nominal_data as $key => $value) {
    $obj = (object)$value;
    if ($obj->ACADEMIC_YEAR === $ac_year) {
        $total_population = $obj->SUB_TOTAL;
    }
}

$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'attribute' => 'INTAKE_NAME',
        'format' => 'raw',
        'value' => function ($model, $key, $index) use ($date_obj) {
            $url = \yii\helpers\Url::toRoute(['//col-details']);

            return \yii\helpers\Html::a($model['INTAKE_NAME'], $url, [
                'data-method' => 'get',
                'id' => 'act-btn',
                'data-params' => [
                    'intake_name' => $model['INTAKE_NAME'],
                    'start_date' => $date_obj->START_DATE,
                    'end_date' => $date_obj->END_DATE,
                    //'_csrf' => Yii::$app->request->csrfToken
                ],
                'class' => 'btn btn-link']);
        }
    ],
    'COMPLETE_APPLICATIONS',
    'INCOMPLETE_APPLICATIONS',
    'INTAKE_TOTAL'
];

$nominal_url = \yii\helpers\Url::toRoute(['//nominal-roll']);
$nominal_file_url = \yii\helpers\Url::to('@web/downloads/Nominall roll Per Academic Year Gender.xls');
?>
<div class="row">
    <div class="text-center col-md-2">
        <div class="small-box bg-red-active">
            <div class="inner">
                <h3><?= $student_suspended ?></h3>
                <p>Suspended Students</p>
            </div>
        </div>
    </div>
    <div class="text-center col-md-2">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?= $students_discontinued ?></h3>
                <p>Discontinued Students</p>
            </div>
        </div>
    </div>
    <div class="text-center col-md-2">
        <div class="small-box bg-red-gradient">
            <div class="inner">
                <h3><?= $students_id_application ?></h3>
                <p>Student ID Applications</p>
            </div>
        </div>
    </div>
    <div class="text-center col-md-2">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?= $student_caution_refund ?></h3>
                <p>Caution Refund Application</p>
            </div>
        </div>
    </div>
    <div class="text-center col-md-2">
        <!-- small box -->
        <div class="small-box bg-black-gradient">
            <div class="inner">
                <h3><?= \yii\helpers\Html::a('<i class="glyphicon glyphicon-download"></i>', $nominal_file_url, ['class' => '']) ?></h3>
                <p>Nominal Roll Report</p>
            </div>
        </div>
    </div>
    <div class="text-center col-md-2">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?= $registered_students ?></h3>
                <p>Registered Students</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-money fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">KES <?= $fees_collected ?></div>
                        <div>Fees Collected Today (Mod II)</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
<!--	
	    <div class="col-lg-3 col-md-6">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-money fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        
                        <div>Fees Collected Today (Mod I)</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
	-->
	
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-clone fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $currency . ' ' . $application_fees_collected ?></div>
                        <div>Application Fees Collected Today</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-university fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $total_population ?></div>
                        <div>Student Population (<?= $ac_year ?>)</div>
                    </div>
                </div>
            </div>
            <a href="<?= $nominal_url ?>">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-folder-open fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $applications ?></div>
                        <div>Applications</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Student Intake Statistics between <?= $date_obj->START_DATE ?>
                and <?= $date_obj->END_DATE ?></div>
            <div class="panel-body">
                <?= $this->render('_intake-chart', ['chartdata' => $chartdata]) ?>
            </div>
        </div>
    </div>
</div>
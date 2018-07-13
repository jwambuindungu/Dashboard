<?php
/* @var $this yii\web\View */
/* @var $chartdata array */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $start_date string */
/* @var $col_code string */
/* @var $end_date string */
/* @var $intake_name string */
/* @var $status boolean */

$this->params['breadcrumbs'][] = ['label' => 'Student Reports', 'url' => ['//student-reports']];
$this->params['breadcrumbs'][] = ['label' => 'Intake Details', 'url' => ['//intake-details', [
    //'status' => $status,
    'intake_name' => $intake_name,
    'col_code' => $col_code,
    'start_date' => $start_date,
    'end_date' => $end_date]]];
$this->params['breadcrumbs'][] = $this->title;

$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    'APPLICATION_REF_NO',
    'APPLICANT_NAME',
    'GENDER',
    'COUNTRY_NAME',
    'EMAIL_ADDRESS:email',
    'MOBILE_NO',
    'DEGREE_CODE',
    'PROGRAMME_NAME',
    'INTAKE_NAME',
    'APPLICATION_DATE:date'
]
?>

<div class="row">
    <?= \yii\helpers\Html::a('<< BACK', ['//intake-details'], [
        'data-method' => 'get',
        'data-params' => [
            //'status' => $status,
            'col_code' => $col_code,
            'intake_name' => $intake_name,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ],
        'class' => 'btn btn-success']); ?>
</div>
<hr/>
<div class="row">
    <?=
    \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'export' => false,
        'columns' => $gridColumns,
        'responsive' => true,
        'hover' => true,
        'striped' => true,
        'condensed' => true,
        'pjax' => true,
        'panel' => [
            'type' => $status ? \kartik\grid\GridView::TYPE_SUCCESS : \kartik\grid\GridView::TYPE_DANGER,
            'heading' => $this->title//"Student Intake Statistics between $start_date and $end_date for $intake_name",
        ],
        'toggleData' => true,
        'toggleDataOptions' => ['minCount' => 10]
    ]);
    ?>
</div>

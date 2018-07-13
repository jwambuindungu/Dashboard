<?php
/* @var $this yii\web\View */
/* @var $chartdata array */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $start_date string */
/* @var $end_date string */
/* @var $intake_name string */


$this->params['breadcrumbs'][] = ['label' => 'Student Reports', 'url' => ['//student-reports']];
$this->params['breadcrumbs'][] = $this->title;


$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'header' => 'College Code',
        'attribute' => 'COL_CODE',
        'format' => 'raw',
        'value' => function ($model) use ($start_date, $end_date) {
            $url = \yii\helpers\Url::toRoute(['//intake-details']);

            return \yii\helpers\Html::a($model['COL_CODE'], $url, [
                'data-method' => 'get',
                'id' => 'act-btn',
                'data-params' => [
                    'col_code' => $model['COL_CODE'],
                    'intake_name' => $model['INTAKE_NAME'],
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    //'_csrf' => Yii::$app->request->csrfToken
                ],
                'class' => 'btn btn-link']);
        }
    ],
    [
        'attribute' => 'COMPLETE_APPLICATIONS',
        'vAlign' => 'middle',
        'hAlign' => 'center',
    ],
    [
        'attribute' => 'INCOMPLETE_APPLICATIONS',
        'vAlign' => 'middle',
        'hAlign' => 'center',
    ],
    [
        'attribute' => 'INTAKE_TOTAL',
        'vAlign' => 'middle',
        //'hAlign' => 'center',
    ],
]
?>

<div class="row">
    <?= \yii\helpers\Html::a('<< BACK', ['//student-reports'], ['class' => 'btn btn-success']); ?>
</div>
<hr/>
<div class="row">
    <?=
    \kartik\grid\GridView::widget(['dataProvider' => $dataProvider,
        'export' => false,
        'columns' => $gridColumns,
        'responsive' => true,
        'hover' => true,
        'striped' => true,
        'condensed' => true,
        'pjax' => true,
        'panel' => ['type' => \kartik\grid\GridView::TYPE_INFO,
            'heading' => "Student Intake Statistics per college between $start_date and $end_date for $intake_name",],
        'toggleData' => true,
        'toggleDataOptions' => ['minCount' => 10]]);
    ?>
</div>
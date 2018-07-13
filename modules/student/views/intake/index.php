<?php
/* @var $this yii\web\View */
/* @var $chartdata array */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $col_code string */
/* @var $start_date string */
/* @var $end_date string */
/* @var $intake_name string */


$this->params['breadcrumbs'][] = ['label' => 'Student Reports', 'url' => ['//student-reports']];
$this->params['breadcrumbs'][] = $this->title;


$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'attribute' => 'DEGREE_CODE',
        'vAlign' => 'middle',
        //'hAlign' => 'center',
        'visible' => false
    ],
    [
        'attribute' => 'PROGRAMME_NAME',
        'vAlign' => 'middle',
        //'hAlign' => 'center',
    ],
    [
        'attribute' => 'COMPLETE_APPLICATIONS',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'format' => 'raw',
        'value' => function ($model, $key, $index) use ($start_date, $end_date, $col_code) {
            $url = \yii\helpers\Url::toRoute(['//prog-details']);

            if ($model['COMPLETE_APPLICATIONS'] <= 0) {
                return $model['COMPLETE_APPLICATIONS'];
            }
            return \yii\helpers\Html::a($model['COMPLETE_APPLICATIONS'], $url, [
                'data-method' => 'get',
                'data-params' => [
                    //'pjax' => 0,
                    'status' => 1,
                    'col_code' => $col_code,
                    'intake_name' => $model['INTAKE_NAME'],
                    'deg_code' => $model['DEGREE_CODE'],
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    //'_csrf' => Yii::$app->request->csrfToken
                ],
                'class' => 'btn btn-default btn-block']);
        }
    ],
    [
        'attribute' => 'INCOMPLETE_APPLICATIONS',
        'vAlign' => 'middle',
        'hAlign' => 'center',
        'format' => 'raw',
        'value' => function ($model, $key, $index) use ($end_date, $start_date, $col_code) {
            $url = \yii\helpers\Url::toRoute(['//prog-details']);
            if ($model['INCOMPLETE_APPLICATIONS'] <= 0) {
                return $model['INCOMPLETE_APPLICATIONS'];
            }
            return \yii\helpers\Html::a($model['INCOMPLETE_APPLICATIONS'], $url, [
                'data-method' => 'get',
                'data-params' => [
                    //'pjax' => 0,
                    'status' => 0,
                    'col_code' => $col_code,
                    'intake_name' => $model['INTAKE_NAME'],
                    'deg_code' => $model['DEGREE_CODE'],
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    //'_csrf' => Yii::$app->request->csrfToken
                ],
                'class' => 'btn btn-warning btn-block']);
        }
    ],
    [
        'attribute' => 'INTAKE_TOTAL',
        'vAlign' => 'middle',
        //'hAlign' => 'center',
    ],
]
?>

<div class="row">
    <div class="row">
        <?= \yii\helpers\Html::a('<< BACK', ['//col-details'], [
            'data-method' => 'get',
            'data-params' => [
                'col_code' => $col_code,
                'intake_name' => $intake_name,
                'start_date' => $start_date,
                'end_date' => $end_date,
            ],
            'class' => 'btn btn-success']); ?>
    </div>
</div>

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
        'panel' => ['type' => \kartik\grid\GridView::TYPE_PRIMARY,
            'heading' => "Student Intake Statistics between $start_date and $end_date for $intake_name",],
        'toggleData' => true,
        'toggleDataOptions' => ['minCount' => 10]]);
    ?>
</div>
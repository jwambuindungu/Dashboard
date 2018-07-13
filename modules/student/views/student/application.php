<?php
/* @var $this yii\web\View */
/* @var $chartdata array */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $date_obj string */

$this->params['breadcrumbs'][] = $this->title;

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
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading"><h4>Student Intake Statistics between <?= $date_obj->START_DATE ?>
                    and <?= $date_obj->END_DATE ?></h4></div>
            <div class="panel-body">
                <?=
                \kartik\grid\GridView::widget([
                    'dataProvider' => $dataProvider,
                    'export' => false,
                    'columns' => $gridColumns,
                    'responsive' => true,
                    'hover' => true,
                    'toggleData' => false,
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
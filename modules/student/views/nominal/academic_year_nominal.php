<?php
/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;

$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'attribute' => 'ACADEMIC_YEAR',
        'format' => 'raw',
        'value' => function ($model, $key, $index) {
            $url = \yii\helpers\Url::toRoute(['//nominal-year']);

            return \yii\helpers\Html::a($model['ACADEMIC_YEAR'], $url, [
                'data-method' => 'get',
                'id' => 'act-btn',
                'data-params' => [
                    'ac_year' => $model['ACADEMIC_YEAR'],
                ],
                'class' => 'btn btn-link']);
        }
    ],
    'FEMALE',
    'MALE',
    'SUB_TOTAL'
];

?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading"><?= $this->title?></div>
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

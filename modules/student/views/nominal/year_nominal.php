<?php
/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;

$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'attribute' => 'COL_CODE',
        'width' => '100%',
        'value' => function ($model, $key, $index, $widget) {
            $col_code = $model['COL_CODE'];
            return $col_code;
        },
        //'filterInputOptions' => ['placeholder' => 'Type payroll number'],
        'group' => true,  // enable grouping,
        'groupedRow' => true,                    // move grouped column to a single grouped row
        'groupOddCssClass' => 'kv-grouped-row',  // configure odd group cell css class
        'groupEvenCssClass' => 'kv-grouped-row', // configure even group cell css class
    ],
    'ACADEMIC_YEAR',
    //'COL_CODE',
    'DEGREE_CODE',
    'DEGREE_NAME',
    'F',
    'M',
    [
        'header' => 'SUB TOTAL',
        'attribute' => 'F',
        'value' => function ($model, $key, $index, $widget) {
            $female = $model['F'];
            $male = $model['M'];
            $total = (int)$male + (int)$female;
            return $total;
        },
    ],
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

<?php
/* @var $this yii\web\View */
/* @var $chartdata array */
/* @var $dataProvider \yii\data\ActiveDataProvider */


use enscope\Yii2ChartJs\ChartJsWidget;

$labelCount = 1;

$complete_color = '#318507';//\app\Colors\RandomColor::one(['hue' => 'green','lumino']);

$incomplete_color = 'rgb(255, 0, 0)';//\app\Colors\RandomColor::many($labelCount, [//'hue' => 'red']);
?>
<?= ChartJsWidget::widget([
    'chartType' => ChartJsWidget::CHART_BAR,
    'id' => 'bar',
    'canvasOptions' => [
        'height' => 477
    ],
    'chartOptions' => [
        'animation' => false,
        'bezierCurve' => false,
        'maintainAspectRatio' => false,
        'responsive' => true,
        'tooltips' => [
            'callbacks' => [
                'label' => ChartJsWidget::js('function (item) { return (item.yLabel); }')
            ]
        ],
        'legend' => [
            'display' => true,
            'position' => 'bottom'
        ]
    ],
    'chartData' => [
        'labels' => $chartdata->labels,
        'datasets' => [
            [
                'label' => 'COMPLETE APPLICATIONS (Applied for a course and Paid)',
                'data' => $chartdata->complete,
                'borderColor' => $complete_color,
                'fill' => false,
                'backgroundColor' => $complete_color
            ],
            [
                'label' => 'INCOMPLETE APPLICATIONS (Applied for a course but not Paid)',
                'data' => $chartdata->incomplete,
                'borderColor' => $incomplete_color,
                'fill' => false,
                'backgroundColor' => $incomplete_color

            ]
        ]
    ]
]) ?>
<?php

/* @var $this yii\web\View */

$this->params['breadcrumbs'][] = $this->title;
?>
<?= \yiier\chartjs\ChartJs::widget([
    'type' => \app\components\CHART_TYPES::LINE,
    'options' => [
        'height' => 200,
        'width' => 600
    ],
    'data' => [
        'labels' => ["January", "February", "March", "April", "May", "June", "July", "Aug", "Sep"],
        'datasets' => [
            [
                'label' => '# of Votes',
                'data' => [65, 59, 90, 81, 56, 55, 40, 78, 9],
                'borderWidth' => 5,
                'backgroundColor' => [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
            ],
            [
                'label' => '# of Votes',
                'data' => [28, 48, 40, 19, 96, 27, 100, 78, 45],
                'backgroundColor' => [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
            ]
        ]
    ]
]); ?>

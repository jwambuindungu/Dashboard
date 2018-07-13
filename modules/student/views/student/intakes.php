<?php
/* @var $this yii\web\View */

\app\assetmanager\FusionChartAsset::register($this);
//ptrnov\fusionchart\ChartAsset::register($this);
//$this->registerJsFile(Yii::$app->request->baseUrl . '/fusionjs/fusioncharts.js');//,['depends' => [\yii\web\JqueryAsset::className()]]);
?>


<div id="chartContainer">FusionCharts XT will load here!</div>

<script type="text/javascript">
    FusionCharts.ready(function(){
        var fusioncharts = new FusionCharts({
                type: 'column2d',
                renderAt: 'chartContainer',
                width: '800',
                height: '500',
                dataFormat: 'json',
                dataSource: {
                    "chart": {
                        "caption": "Monthly Revenue",
                        "subCaption": "Last year",
                        "xAxisName": "Month",
                        "yAxisName": "Amount (In USD)",
                        "numberPrefix": "$",
                        "canvasBgAlpha": "0",
                        "bgColor": "#DDDDDD",
                        "bgAlpha": "50",
                        "theme": "fint",
                        "exportEnabled": "1"
                    },

                    "data": [{
                        "label": "Jan",
                        "value": "420000"
                    }, {
                        "label": "Feb",
                        "value": "810000"
                    }, {
                        "label": "Mar",
                        "value": "720000"
                    }, {
                        "label": "Apr",
                        "value": "550000"
                    }, {
                        "label": "May",
                        "value": "910000"
                    }, {
                        "label": "Jun",
                        "value": "510000"
                    }, {
                        "label": "Jul",
                        "value": "680000"
                    }, {
                        "label": "Aug",
                        "value": "620000"
                    }, {
                        "label": "Sep",
                        "value": "610000"
                    }, {
                        "label": "Oct",
                        "value": "490000"
                    }, {
                        "label": "Nov",
                        "value": "900000"
                    }, {
                        "label": "Dec",
                        "value": "730000"
                    }]
                }
            }
        );
        fusioncharts.render();
    });
</script>
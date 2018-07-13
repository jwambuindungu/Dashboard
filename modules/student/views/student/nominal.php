<?php
use ptrnov\fusionchart\ChartAsset;

ChartAsset::register($this);

$model = \app\modules\student\models\NOMINAL_ROLL_MODEL::NOMINAL_AC_YEAR();
?>

<?=
\ptrnov\fusionchart\Chart::Widget([
    'dataArray' => $model,                        //array scource model or manual array or sqlquery
    'dataField' => ['FEMALE', 'MALE'],                //field['label','value'], normaly value is numeric
    'type' => 'column3d',                            //Chart Type
    'renderid' => 'chartContainer',                //unix name render
    'chartOption' => [
        'caption' => 'judul Header',            //Header Title
        'subCaption' => 'judul Sub',            //Sub Title
        'xaxisName' => 'Month',                //Title Bawah/ posisi x
        'yaxisName' => 'Jumlah',                //Title Samping/ posisi y
        'theme' => 'fint',                    //Theme
        'palettecolors' => "#583e78,#008ee4,#f8bd19,#e44a00,#6baa01,#ff2e2e",
        'bgColor' => "#ffffff",                //color Background / warna latar
        'showBorder' => "0",                    //border box outside atau garis kotak luar
        'showCanvasBorder' => "0",            //border box inside atau garis kotak dalam
    ],
]);
?>

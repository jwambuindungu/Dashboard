<?php
/* @var $this yii\web\View */

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\modules\smis\models\SMIS;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

\app\assetmanager\FusionChartAsset::register($this);

$ylist = ArrayHelper::map(SMIS::ACA_YEAR(),'INTAKE_NAME',function($d){return $d['ACADEMIC_YEAR'].' - '.$d['INTAKE_NAME'];});

$form = ActiveForm::begin([
    'id' => 'active-form',
    'method' => 'get',
    'action' => Url::to(['']),
]);
/* ADD FORM FIELDS */
echo '<div class="row"><div class="form-group"><div class="col-xs-12">';
echo Select2::widget([
    'name' => 'intake',
    'data' => $ylist,
    'options' => ['placeholder' => '--Select Academic Year--','onchange'=>'this.form.submit()'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);
echo '</div></div></div>';
ActiveForm::end();

$vroll='';
if(!empty($data)){

    $intake_name = $intake;
    $dataset=$app=$adm=$rep=$labels=[];

    foreach ($data as $key => $value) {
        $obj = (object)$value;
        $labels[] = ['label'=>$obj->COL_CODE];
        $app[] = ['value'=>$obj->APPLICANTS];
        $adm[] = ['value'=>$obj->ADMITTED];
        $rep[] = ['value'=>$obj->REPORTED];
    }

    $dataset[]=["seriesname"=>"Applied","data"=>$app];
    $dataset[]=["seriesname"=>"Admitted","data"=>$adm];
    $dataset[]=["seriesname"=>"Reported","data"=>$rep];

    $graphData = [
            "chart"=>[
                "caption"=> "Application Analysis Report for $intake_name",
                "paletteColors"=> "#2bb9cf",
                "bgColor"=> "#ffffff",
                "borderAlpha"=> "20",
                "canvasBorderAlpha"=> "1",
                "usePlotGradientColor"=> "0",
                "formatNumberScale"=> false, "rotatevalues"=> "1",
                "plotBorderAlpha"=> "10",
                "showXAxisLine"=> "1",
                "xAxisLineColor"=> "#2bb9cf",
                "showValues"=> "1",
                "showlegend"=> "1",
                "divlineColor"=> "#2bb9cf",
                "divLineIsDashed"=> "1",
                "xaxisname"=>"No. of Students",
                "yaxisname"=>"Colleges",
//                "numberSuffix"=> "%",
                "yaxismaxvalue"=>  "100",
                "exportEnabled"=>"1",

                //Deviation from theme
                "placeValuesInside"=> "0",
                "rotateValues"=> "0",
                "valueFontColor"=> "#000000",
                "valueBgColor"=> "#FFFFFF",
                "valueBgAlpha"=> "80",
                "paletteColors"=> "#f45b00,#8e00gc,#8ef465,#8e0000,#8e087d",
                "exportFormats"=> "PNG=Export as High Quality Image|PDF=Export as PDF|XLS=Export as Excel data",
                "exportFileName"=>"Application_Analysis_Report_$intake_name",
                "showAlternateHGridColor"=> "#cccc"
            ],
            "categories"=>[
                ["category"=>$labels],
            ],
            "dataset"=>$dataset,
    ];

//    print_r(json_encode($graphData)); exit;
    $applicants_total = 0;
    $pending_total = 0;
    $unverified_total = 0;
    $verified_total = 0;
    $shortlisted_total = 0;
    $not_shortlisted_total = 0;
    $pendg_shortlisting_total = 0;
    $admitted_total = 0;
    $not_admitted_total = 0;
    $published_total = 0;
    $reported_total = 0;
    $prog_types = "";
    $prog_types_label = "";

    $vroll='<div class="box box-primary text-center">
    <div class="box-header with-border">
        <h4 class="box-title text-center text-capitalize">Application Analysis Report</h4>
        <h4 class="box-title text-center text-capitalize">'.$intake_name.'</h4>

    </div>

    <div class="box-body">';

    $vroll .="<table class='table table-bordered table-striped table-hover'>";
    $vroll .="<thead class='text-info text-bold'><tr align='left' ><th class='' >College</th>";
    $vroll .="<th class=''>Completed Applications</th>";
    $vroll .="<th class=''>Pending Verification</th>";
    $vroll .="<th class=''>Verified</th>";
    $vroll .="<th class=''>Unverified/Follow Up Cases</th>";
    $vroll .="<th class=''>Shortlisted</th>";
    $vroll .="<th class=''>Not Shortlisted</th>";
    $vroll .="<th class=''>Pending Shortlisting</th>";
    $vroll .="<th class=''>Admitted</th>";
    $vroll .="<th class=''>Not Admitted</th>";
    $vroll .="<th class=''>Notified</th>";
    $vroll .="<th class=''>Reported </th></tr></thead>";
    $vroll .="<tbody>";
    foreach($data as $key => $value){
        $colls['label'][]=$value['COL_CODE'];
        $colls['label'][]=$value['COL_CODE'];
        $vroll .="<tr align='left' >";
        $vroll .="<td class='text-right'>".$value['COL_CODE']."</td>";
        $vroll .="<td class='text-right'>".number_format($value['APPLICANTS'],0)."</td>";
        $vroll .="<td class='text-right'>".number_format($value['PENDING_VERIFICATION'],0)."</td>";
        $vroll .="<td class='text-right'>".number_format($value['VERIFIED'],0)."</td>";
        $vroll .="<td class='text-right'>".number_format($value['UNVERIFIED'],0)."</td>";
        $vroll .="<td class='text-right'>".number_format($value['SHORTLISTED'],0)."</td>";
        $vroll .="<td class='text-right'>".number_format($value['NOT_SHORTLISTED'],0)."</td>";
        $vroll .="<td class='text-right'>".number_format($value['PENDING_SHORTLISTING'],0)."</td>";
        $vroll .="<td class='text-right'>".number_format($value['ADMITTED'],0)."</td>";
        $vroll .="<td class='text-right'>".number_format($value['NOT_ADMITTED'],0)."</td>";
        $vroll .="<td class='text-right'>".number_format($value['LETTER_PUBLISHED'],0)."</td>";
        $vroll .="<td class='text-right'>".number_format($value['REPORTED'],0)."</td>";
        $vroll .="</tr>";
        $applicants_total = $applicants_total + $value['APPLICANTS'];
        $pending_total = $pending_total + $value['PENDING_VERIFICATION'];
        $unverified_total = $unverified_total + $value['UNVERIFIED'];
        $verified_total = $verified_total + $value['VERIFIED'];
        $pendg_shortlisting_total = $pendg_shortlisting_total + $value['PENDING_SHORTLISTING'];
        $shortlisted_total = $shortlisted_total + $value['SHORTLISTED'];
        $not_shortlisted_total = $not_shortlisted_total + $value['NOT_SHORTLISTED'];
        $admitted_total = $admitted_total + $value['ADMITTED'];
        $not_admitted_total = $not_admitted_total + $value['NOT_ADMITTED'];
        $published_total = $published_total + $value['LETTER_PUBLISHED'];
        $reported_total = $reported_total + $value['REPORTED'];
    }
    $vroll .="</tbody>";
    $vroll .="<tfoot class='text-primary'><tr align='left'>";
    $vroll .="<th class='text-right'><b>Totals</b></th>";
    $vroll .="<th class='text-right'><b>".number_format($applicants_total,0)."</b></th>";
    $vroll .="<th class='text-right'><b>".number_format($pending_total,0) ."</b></th>";
    $vroll .="<th class='text-right'><b>".number_format($verified_total,0) ."</b></th>";
    $vroll .="<th class='text-right'><b>".number_format($unverified_total,0) ."</b></th>";
    $vroll .="<th class='text-right'><b>".number_format($shortlisted_total,0) ."</b></th>";
    $vroll .="<th class='text-right'><b>".number_format($not_shortlisted_total,0) ."</b></th>";
    $vroll .="<th class='text-right'><b>".number_format($pendg_shortlisting_total,0) ."</b></th>";
    $vroll .="<th class='text-right'><b>".number_format($admitted_total,0) ."</b></th>";
    $vroll .="<th class='text-right'><b>".number_format($not_admitted_total,0) ."</b></th>";
    $vroll .="<th class='text-right'><b>".number_format($published_total,0) ."</b></th>";
    $vroll .="<th class='text-right'><b>".number_format($reported_total,0) ."</b></th>";
    $vroll .="</tr></tfoot>";
    $vroll .="</table>";

    $vroll.='</div></div>';

    $jsonEncodedData = json_encode($graphData);
    $columnChart = new app\modules\smis\fusion_charts\src\FusionCharts("MSColumn2D","myFirstChart", '100%', 500, "chart-1", "json", $jsonEncodedData);
    $columnChart->render();

    echo'<div id="chart-1"><!-- Fusion Charts will render here--></div>';
}

if(empty($data)){
    $vroll='<div>No Data Found!!</div>';
}

echo $vroll;

?>


<script type="text/javascript">
    FusionCharts.ready(function(){

        $(this).delay(1000).queue(function() {
            $('[class$="-creditgroup"]').each(function() {
                $(this).css('display','none')
            });
            $(this).dequeue();
        });
    });
</script>

<style>
    table, table>thead>tr>th, table>tfoot>tr>th, table>tbody>tr>td {
        border: 1px solid #99979c !important;
    }
</style>
<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use app\modules\uspas\models\USPAS;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

\app\assetmanager\FusionChartAsset::register($this);
?>

	
	<?php 
// use  app\modules\uspas\fusionchart;
// yii\helpers\Url

    // Form the SQL query that returns the top 10 most populous countries
   // $strQuery = "SELECT Name, Population FROM Country ORDER BY Population DESC LIMIT 10";

    // Execute the query, or else return the error message.
   // $result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

    // If the query returns a valid response, prepare the JSON string
   
        // The `$arrData` array holds the chart attributes and data
        $arrData = array(
            "chart" => array(
              "caption" => "% of College Staff with complete Supervisor Evaluation for the year ",
              //"paletteColors" => "#0075c2",
              "paletteColors" => "#2bb9cf",
              "bgColor" => "#ffffff",
              "borderAlpha"=> "20",
              "canvasBorderAlpha"=> "1",
              "usePlotGradientColor"=> "0",
              "plotBorderAlpha"=> "10",
              "showXAxisLine"=> "1",
              "xAxisLineColor" => "#2bb9cf",
              "showValues" => "1",
			  "showlegend"=> "1",
              //"divlineColor" => "#999999",
              "divlineColor" => "#2bb9cf",
              "divLineIsDashed" => "1",
			  "yAxisName"=> "Number of Staff",
			  "xAxisName"=> "UoN Colleges",
			  "numberSuffix"=> "%",
			  "yaxismaxvalue"=>  "100",
			   "exportEnabled"=>"1",
			   "paletteColors"=> "#0075c2,#1aaf5d,#f2c500,#f45b00,#8e00gc,#8ef465,#8e0000,#8e087d",
			   
			   "exportFormats"=> "PNG=Export as High Quality Image|PDF=Export as PDF|XLS=Export as Excel data",
			   "exportFileName"=>"Collages_Appraisal_Graph_2015/2016",
              "showAlternateHGridColor" => "#cccc"
            )
        );

        $arrData["data"] = array();
//$dept_total = $rsmain->fields[0]; $dept_code = $rsmain->fields[2];
// Push the data into the array   
     $res = $data;
		foreach($res as $k){
		//while($strsarr2 = $rsmain2->FetchRow())
		//{
				IF($k["COL_CODE"]=='01')
		{
			$col_name="CENTRAL";
		}
		ELSE IF($k["COL_CODE"]=='02')
		{
			$col_name="CAVS";
		}
		ELSE IF($k["COL_CODE"]=='03')
		{
			$col_name="CAE";
		}
		ELSE IF($k["COL_CODE"]=='04')
		{
			$col_name="CHSS";
		}
		ELSE IF($k["COL_CODE"]=='05')
		{
			$col_name="CBPS";
		}
		ELSE IF($k["COL_CODE"]=='06')
		{
			$col_name="CHS";
		}
		ELSE IF($k["COL_CODE"]=='07')
		{
			$col_name="CEES";
		}
		ELSE IF($k["COL_CODE"]=='11')
		{
			$col_name="SWA";
		}
		ELSE 
		{
			$col_name=$k["COL_NAME"];
		}
				
        array_push($arrData["data"], array(
            "label" => $col_name ,
//"value" => number_format(($strsarr2[0]/$col_total)*100,2)
            "value" => number_format(($k["APPRAISED"]/$k["TOTAL"])*100,2)
            )
        );
        }
		

        /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        $jsonEncodedData = json_encode($arrData);

/*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

        $columnChart = new app\modules\uspas\fusion_charts\src\FusionCharts("column3d", "myFirstChart" , '100%', 500, "chart-1", "json", $jsonEncodedData);

        // Render the chart
        $columnChart->render();

if($range) {
    $form = ActiveForm::begin([
        'id' => 'active-form',
        'options' => [
            'class' => 'form-horizontal text-center',
            'enctype' => 'multipart/form-data'
        ],
        'method' => 'get',
        'action' => Url::to(['']),
    ]);
    /* ADD FORM FIELDS */
    echo '<div class="form-group"><div class="col-xs-4">';
    echo Html::dropDownList('yr', null,
        ArrayHelper::map(USPAS::APPRAISAL_YEARLIST(), 'yr', 'yr'),
        ['prompt' => 'Choose Appraisal Year ', 'class' => 'form-control', 'onchange' => 'this.form.submit()']);
    echo '</div></div>';
    ActiveForm::end();
}
echo'<div id="chart-1"><!-- Fusion Charts will render here--></div>';

	//$rsmain->MoveNext();
	
	
	
	
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
	

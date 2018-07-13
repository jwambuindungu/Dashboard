<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
\app\assetmanager\FusionChartAsset::register($this);
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
              "caption" => "CURRENTLY ONGOING PROJECTS PER COLLEGE BY TOTAL BUDGET AMOUNT",
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
			  "yAxisName"=> "Amount in Millions",
			  "xAxisName"=> "UoN Colleges",
			  "numberSuffix"=> "M",
			   "exportEnabled"=>"1",
			   "paletteColors"=> "#0075c2,#1aaf5d,#f2c500,#f45b00,#8e00gc,#8ef465,#8e0000,#8e087d",
			   
			   "exportFormats"=> "PNG=Export as High Quality Image|PDF=Export as PDF|XLS=Export as Excel data",
			   "exportFileName"=>"College_Current_Grant_Status",
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
			IF($k["COLLEGE_CODE"]=='01')
		{
			$col_name="CENTRAL";
		}
		ELSE IF($k["COLLEGE_CODE"]=='02')
		{
			$col_name="CAVS";
		}
		ELSE IF($k["COLLEGE_CODE"]=='03')
		{
			$col_name="CAE";
		}
		ELSE IF($k["COLLEGE_CODE"]=='04')
		{
			$col_name="CHSS";
		}
		ELSE IF($k["COLLEGE_CODE"]=='05')
		{
			$col_name="CBPS";
		}
		ELSE IF($k["COLLEGE_CODE"]=='06')
		{
			$col_name="CHS";
		}
		ELSE IF($k["COLLEGE_CODE"]=='07')
		{
			$col_name="CEES";
		}
		ELSE IF($k["COLLEGE_CODE"]=='11')
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
            "value" => number_format(($k["TOTAL_BUDGET"])/1000000,2)
            )
        );
        }
		

        /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        $jsonEncodedData = json_encode($arrData);

/*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

        $columnChart = new app\modules\rgmis\fusion_charts\src\FusionCharts("column3d", "myFirstChart" , '100%', 500, "chart-1", "json", $jsonEncodedData);

        // Render the chart
        $columnChart->render();

        
    



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
	

<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
\app\assetmanager\FusionChartAsset::register($this);
// use  app\modules\uspas\fusionchart;
// yii\helpers\Url
?>

	
	<?php 
	



    // Form the SQL query that returns the top 10 most populous countries
   // $strQuery = "SELECT Name, Population FROM Country ORDER BY Population DESC LIMIT 10";

    // Execute the query, or else return the error message.
   // $result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

    // If the query returns a valid response, prepare the JSON string
   
        // The `$arrData` array holds the chart attributes and data
        $arrData = array(
            "chart" => array(
              "caption" => "% PI NET GRANT VALUE VS ADMIN COST",
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
			  "linethickness"=>  "3",
              //"divlineColor" => "#999999",
              "divlineColor" => "#2bb9cf",
              "divLineIsDashed" => "1",
			  "yAxisName"=> "Number of Staff",
			  "xAxisName"=> "UoN Colleges",
			  "numberSuffix"=> "%",
			   "exportEnabled"=>"1",
			   "paletteColors"=> "#ff0000,#B0D67A",
			   
			   "exportFormats"=> "PNG=Export as High Quality Image|PDF=Export as PDF|XLS=Export as Excel data",
			   "exportFileName"=>"Current_University_Grant_Status",
              "showAlternateHGridColor" => "#cccc"
            )
        );
		
		/*
		 "caption": "Marketing Expenses for 2013",
        "numberprefix": "$",
        "plotgradientcolor": "",
        "bgcolor": "FFFFFF",
        "showalternatehgridcolor": "0",
        "showplotborder": "0",
        "divlinecolor": "CCCCCC",
        "showvalues": "1",
        "showcanvasborder": "0",
        "canvasbordercolor": "CCCCCC",
        "canvasborderthickness": "1",
        //"yaxismaxvalue": "30000",
        "captionpadding": "30",
        "linethickness": "3",
        "sshowanchors": "0",
        "yaxisvaluespadding": "1",
        "showlegend": "1",
        "use3dlighting": "0",
        "showshadow": "0",
        "legendshadow": "0",
        "legendborderalpha": "0",
        "showborder": "0",
        "palettecolors": "#EED17F,#97CBE7,#074868,#B0D67A,#2C560A,#DD9D82"
		*/

        $arrData["data"] = array();
//$dept_total = $rsmain->fields[0]; $dept_code = $rsmain->fields[2];
// Push the data into the array   
     $res = $data;
		foreach($res as $k){
		//while($strsarr2 = $rsmain2->FetchRow())
		//{
			

				
        //array_push($arrData["data"], array(


          $arrData['data']=array(
			
			array(
					"label" => '% ADMIN COST',
					 "value" => number_format(($k["OVERHEAD_AMOUNT"]/$k["TOTAL_BUDGET"])*100,2),
					 	// "value" => number_format(($k["OVERHEAD_AMOUNT"]/$k["TOTAL_BUDGET"])*100,2),
					 "issliced"=> "1"
					
				),
				array(
					"label" => '% PI NET GRANT AMOUNT',
					"value" => number_format(($k["PI_NET_GRANT"]/$k["TOTAL_BUDGET"])*100,2),
					  "issliced"=> "1"
				)
			
			
            );
        //);
        }
		

        /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        $jsonEncodedData = json_encode($arrData);

/*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

        $columnChart = new app\modules\rgmis\fusion_charts\src\FusionCharts("pie2d", "myFirstChart2" , '100%', 500, "chart-2", "json", $jsonEncodedData);

        // Render the chart
        $columnChart->render();

        
    



echo'<div " id="chart-2"><!-- Fusion Charts will render here--></div>';

	//$rsmain->MoveNext();
	
	
	
	
?>
</p>
	
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
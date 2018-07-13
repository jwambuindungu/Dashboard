<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use app\modules\uspas\models\USPAS;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

\app\assetmanager\FusionChartAsset::register($this);
$user = Yii::$app->session->get('user_details');
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
              "caption" => "% of {$user['DEPT_NAME']} Staff with complete Supervisor Evaluation for the year $yr",
              //"paletteColors" => "#0075c2",
             // "paletteColors" => "#2bb9cf",
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
			  "xAxisName"=> "College Departments",
			  "numberSuffix"=> "%",
			  "yaxismaxvalue"=>  "100",
			   "exportEnabled"=>"1",
			   "paletteColors" => "#2bb9cf,#8e0000",               
			   
			   "exportFormats"=> "PNG=Export as High Quality Image|PDF=Export as PDF|XLS=Export as Excel data",
			   "exportFileName"=>"Appraisal_status_percollegedeptforyear_$yr",
              "showAlternateHGridColor" => "#cccc"
            )
        );

        $arrData["data"] = array();
//$dept_total = $rsmain->fields[0]; $dept_code = $rsmain->fields[2];
// Push the data into the array   
     $res = $data;
		foreach($res as $k){
		//while($strsarr2 = $rsmain2->FetchRow())
		
				$dept_name=$k["DEPT_NAME"];
       
		$arrData['data']=array(
			
			array(
					"label" => 'Percentage of Staff Appraised',
					 "value" => number_format(($k["SUPERVISED_TOTAL"]/$k["DEPT_TOTAL"])*100,2),
					 "issliced"=> "1"
					
				),
				array(
					"label" => 'Percentage of Staff not Appraised',
					 "value" => number_format((100-($k["SUPERVISED_TOTAL"]/$k["DEPT_TOTAL"])*100),2),
					  "issliced"=> "1"
				)
			
			
            );
		
		
		
		
		
		
        }
		

        /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        $jsonEncodedData = json_encode($arrData);

/*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

        $columnChart = new app\modules\uspas\fusion_charts\src\FusionCharts("pie3d", "myFirstChart" , '100%', 500, "chart-1", "json", $jsonEncodedData);

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
<div class="clearfix">&nbsp;</div>
<div style="background-color:#fff; padding:10px;">
<h4 class="text-center">Appraisal Status for <?= $user['DEPT_NAME']; ?>. Appraisal Period :<?php echo $yr; ?></h4>
<p>
<style>
.xpTable th,.xpTable td{ padding:5px; background-color:#fff; border:#ccc solid 1px;}
</style>
	<table  align= "center" class="xpTable" border=1 class="table table-bordered table-condensed" style="line-height: 24px; width:70%;">
		<thead>
			<tr>
				
				<th>DEPARTMENT CODE</th>
				<th>DEPARTMENT NAME</th>
				<th>No. OF STAFF TO BE APPRAISED</th>
				<th>STAFF APPRAISED</th>
				<th>APPRAISAL %</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$res = $data;
		foreach($res as $k){
			?>
			<tr>
				
				<td><?= $k["DEPT_CODE"] ?></td>
				<td><?= $k["DEPT_NAME"] ?></td>
				<td><?= $k["DEPT_TOTAL"] ?></td>
				<td><?= $k["SUPERVISED_TOTAL"] ?></td>
				<td><?= number_format(($k["SUPERVISED_TOTAL"]/$k["DEPT_TOTAL"])*100,2) ?></td>
			</tr>
			<?php
		}
		?>
		</tbody>
	</table>
	</div>

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
	

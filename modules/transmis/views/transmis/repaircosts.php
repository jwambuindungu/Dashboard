<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;

\app\assetmanager\FusionChartAsset::register($this);

$gtitle = "TO DATE";
if(!empty($drange)){
    $gtitle = "FROM {$drange[0]} TO {$drange[1]}";
}
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
              "caption" => "OVERALL REPAIR COSTS $gtitle",
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
			  "yAxisName"=> "Amount in KSh.",
			  "xAxisName"=> "Repair Types",
			  "numberSuffix"=> "",
			   "exportEnabled"=>"1",
			   //"paletteColors"=> "#0075c2,#1aaf5d,#f2c500,#f45b00,#8e00gc,#8ef465,#8e0000,#8e087d",
			   "paletteColors" => "#2bb9cf,#0075c2,#09543a,#f2c500,#f45b00,#8e0000,#85d6e7,#eff295,#bd0000,
			  #a3b298,#64a1f4,#c30ba9,#b0df00,#ff8181,#9765de,#f3f98b,#000000,#8c4f19,#ff7800,#eea2ad,#da0080,#3ed2f3,#e9fc00",
              "bgColor" => "#ffffff",
			   
			   "exportFormats"=> "PNG=Export as High Quality Image|PDF=Export as PDF|XLS=Export as Excel data",
			   "exportFileName"=>"Repair_Costs",
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
		/*	IF($k["COLLEGE_CODE"]=='01')
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
			*/	
			
			$col_name=$k["REPAIR_TYPE"];
			$repair_amount=$k["REPAIR_AMOUNT"];
        array_push($arrData["data"], array(
            "label" => $col_name ,
            "value" => $repair_amount
			
//"value" => number_format(($strsarr2[0]/$col_total)*100,2)
            //"value" => number_format(($k["TOTAL_BUDGET"])/1000000,2)
			
            )
        );
        }
		

        /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        $jsonEncodedData = json_encode($arrData);

/*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

        $columnChart = new app\modules\transmis\fusion_charts\src\FusionCharts("column3d", "myFirstChart" , '100%', 500, "chart-1", "json", $jsonEncodedData);

        // Render the chart
        $columnChart->render();

        
    



	//$rsmain->MoveNext();

//$form = ActiveForm::begin([
//    'id' => 'active-form',
//    'options' => [
//        'class' => 'form-horizontal text-center',
//        'enctype' => 'multipart/form-data'
//    ],
//    'method' => 'get',
//    'action' => Url::to(['']),
//]);
/* ADD FORM FIELDS */
$url = Url::to(['']);
echo '<label class="control-label">Click the field below to select the range of dates you would like to review</label>';
echo '<div class="drp-container" style="background-color: #fff; width:600px; border:2px solid #0087CB;">';
echo DateRangePicker::widget([
    'name'=>'date_range',
    'presetDropdown'=>true,
    'hideInput'=>true,
    'callback' => '/*$("#active-form").submit();*/
    function(start, end, label) {
    location.href="'.$url.'?date_range="+start.format(\'DD-MMM-YYYY\')+"~"+end.format(\'DD-MMM-YYYY\');
  }
    ',
]);
echo '</div>';
//ActiveForm::end();
 echo '<div class="clearfix">&nbsp;</div>';


echo'<div id="chart-1"><!-- Fusion Charts will render here--></div>';

if(!empty($data)){
?>
<div class="clearfix">&nbsp;</div>
<div style="background-color:#fff; padding:10px;">
<h4 class="text-center"><?php echo "OVERALL REPAIR COSTS ". $gtitle?></h4>
<p>
<style>
.xpTable th,.xpTable td{ padding:5px; background-color:#fff; border:#ccc solid 1px;}
</style>
	<table  align= "center" class="xpTable" border=1 class="table table-bordered table-condensed" style="line-height: 24px; width:70%;">
		<thead>
			<tr>
				<th>No.</th>
				<th>REPAIR TYPE</th>
				<th>AMOUNT (KES)</th>
				
				
				
			</tr>
		</thead>
		<tbody>
		<?php
		
		$res = $data;
		$total_sum=0;
		 $counter = 1;
		foreach($res as $k){
			?>
			<tr>
			<td><?= $counter;?></td>
				<td><?= $k["REPAIR_TYPE"] ;?></td>
				<td><?= number_format($k["REPAIR_AMOUNT"]); ?></td>
				
				
				
			
			<?php
				$counter++;
				 $total_sum+=$k["REPAIR_AMOUNT"];
		}
		?>	
			</tr>
			<tr>
			<td></td><td><strong class="pull-right" >Total Cost</strong></td><td><strong><?= number_format($total_sum) ;?></strong></td>
			</tr>
			
		</tbody>
	</table>

</div>
<?php }?>

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
	

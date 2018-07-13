<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\modules\rgmis\models\RGMIS;
\app\assetmanager\FusionChartAsset::register($this);

$gtitle = "TO DATE";
if(!empty($yr)){
    $gtitle = " {$yr}";
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
              "caption" => "UNIVERSITY GRANTS PER COLLEGE FOR THE YEAR $gtitle",
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
			  "xAxisName"=> "College",
			  "numberSuffix"=> "",
			   "exportEnabled"=>"1",
			   //"paletteColors"=> "#0075c2,#1aaf5d,#f2c500,#f45b00,#8e00gc,#8ef465,#8e0000,#8e087d",
			   "paletteColors" => "#2bb9cf,#0075c2,#09543a,#f2c500,#f45b00,#8e0000,#85d6e7,#eff295,#bd0000,
			  #a3b298,#64a1f4,#c30ba9,#b0df00,#ff8181,#9765de,#f3f98b,#000000,#8c4f19,#ff7800,#eea2ad,#da0080,#3ed2f3,#e9fc00",
              "bgColor" => "#ffffff",
			   
			   "exportFormats"=> "PNG=Export as High Quality Image|PDF=Export as PDF|XLS=Export as Excel data",
			   "exportFileName"=>"Admincostspercollege",
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
				
			
        array_push($arrData["data"], array(
            "label" => $k["COLLEGE_NAME"] ,
            "value" => $k["TOTAL_OVERHEAD_AMOUNT"],
			
//"value" => number_format(($strsarr2[0]/$col_total)*100,2)
            //"value" => number_format(($k["TOTAL_BUDGET"])/1000000,2)
			
            )
        );
        }
		

        /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        $jsonEncodedData = json_encode($arrData);

/*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

        $columnChart = new app\modules\rgmis\fusion_charts\src\FusionCharts("column3d", "myFirstChart" , '100%', 500, "chart-1", "json", $jsonEncodedData);

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
        ArrayHelper::map(RGMIS::GRANT_YEARLIST(), 'yr', 'yr'),
        ['prompt' => 'Choose  Year ', 'class' => 'form-control', 'onchange' => 'this.form.submit()']);
    echo '</div></div>';
    ActiveForm::end();
}

echo'<div id="chart-1"><!-- Fusion Charts will render here--></div>';

if(!empty($data)){
?>
<div class="clearfix">&nbsp;</div>
<div style="background-color:#fff; padding:10px;">
<h4 class="text-center"><?php echo "COLLECTED GRANTS OVERHEAD COSTS FOR THE YEAR ".$gtitle;?></h4>
<p>
<style>
.xpTable th,.xpTable td{ padding:5px; background-color:#fff; border:#ccc solid 1px;}
</style>
	<table  align= "center" class="xpTable" border=1 class="table table-bordered table-condensed" style="line-height: 24px; width:70%;">
		<thead>
			<tr>
				<th>COLLEGE CODE</th>
				<th>COLLEGE</th>
				<th>TOTAL OVERHEAD COSTS (KES)</th>
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
				<td><?= $k["COLLEGE_NAME"] ;?></td>
				<td><?= number_format($k["TOTAL_OVERHEAD_AMOUNT"]); ?></td>
				
				
				
			
			<?php
				$counter++;
				 $total_sum+=$k["TOTAL_OVERHEAD_AMOUNT"];
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
	

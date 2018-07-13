<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;

\app\assetmanager\FusionChartAsset::register($this);

$gtitle = "FOR $ac_year ACADEMIC YEAR";
$academic_years = app\modules\smis\models\SMIS::ACADEMIC_YEAR();


$acyear_arr = [];
foreach($academic_years as $k){	
		$acyear_arr[$k['ACADEMIC_YEAR']]=$k['ACADEMIC_YEAR'];
			}
	if(!empty($drange)){
    $gtitle = " FROM  {$drange[0]} To {$drange[1]}";
	}
        $arrData = array(
            "chart" => array(
              "caption" => "Total Number of Foreign Students $gtitle",
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
			  "yAxisName"=> "Total Students",
			  "xAxisName"=> "College",
			  "yaxismaxvalue"=>  "100",
			  //"numberSuffix"=> "",
			  "exportEnabled"=>"1",
			   //"paletteColors"=> "#0075c2,#1aaf5d,#f2c500,#f45b00,#8e00gc,#8ef465,#8e0000,#8e087d",
			   "paletteColors" => "#2bb9cf,#0075c2,#09543a,#f2c500,#f45b00,#8e0000,#85d6e7,#eff295,#bd0000,
			  #a3b298,#64a1f4,#c30ba9,#b0df00,#ff8181,#9765de,#f3f98b,#000000,#8c4f19,#ff7800,#eea2ad,#da0080,#3ed2f3,#e9fc00",
              "bgColor" => "#ffffff",
			   
			   "exportFormats"=> "PNG=Export as High Quality Image|PDF=Export as PDF|XLS=Export as Excel data",
			   "exportFileName"=>"aLLFEES_PERIODIC",
              "showAlternateHGridColor" => "#cccc"
            )
        );

        $arrData["data"] = array();
//$dept_total = $rsmain->fields[0]; $dept_code = $rsmain->fields[2];
// Push the data into the array   
     $res = $data;
		foreach($res as $k){	
			$col_name=$k["COL_CODE"];
			$total_amount=$k["STUDENT_COUNT"];
        array_push($arrData["data"], array(
            "label" => $col_name ,
            "value" => $total_amount		
            )
        );
        }
		

        /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        $jsonEncodedData = json_encode($arrData);

/*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

        $columnChart = new app\modules\smis\fusion_charts\src\FusionCharts("column2d", "myFirstChart" , '75%', 300, "chart-1", "json", $jsonEncodedData);

        // Render the chart
        $columnChart->render();
$url = Url::to(['']);

$form = ActiveForm::begin([
    'id' => 'active-form',
    'method' => 'get',
    'action' => Url::to(['']),
]);
echo '<div class="row"><div class="form-group"><div class="col-xs-12">';
echo '<label  class="control-label">Click the field below to select the Academic Year</label>';
echo Select2::widget([
    'name' => 'ac_year',
    'data' => $acyear_arr,
    'options' => ['placeholder' => '--Select Academic Year--','onchange'=>'this.form.submit()'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);
echo '</div></div></div>';
ActiveForm::end();


echo'<div id="chart-1" align= "center"><!-- Fusion Charts will render here--></div>';

if(!empty($data)){
?>
<div class="clearfix">&nbsp;</div>
<div class = "panel panel-info">
   <div class = "panel-heading">
      <h3 class = "panel-title" align ="center"><?php echo " TOTAL NUMBER OF FOREIGN STUDENTS". $gtitle?></h3>
   </div>
<p>
<style>
.xpTable th,.xpTable td{ padding:3px; background-color:#fff; border:#ccc solid 1px;}
</style>
	<table   class="table" style="line-height:5px;width:75%;" align= "center">		 
	<thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">College Code </th>
	  <th scope="col">College Name</th>
      <th scope="col">Total Students</th>
        </tr>
  </thead

		<tbody>
		<?php
		
		$res = $data;
		$total_sum=0;
		 $counter = 1;
		foreach($res as $k){
			?>
			<tr>
			<td><?= $counter;?></td>
				<td><a href="#"a><?= $k["COL_CODE"] ;?></td>
				<td><a href="#"a><?= $k["COL_NAME"] ;?> </td>
				<td><?= number_format($k["STUDENT_COUNT"]); ?></td>
				
				
				
			
			<?php
				$counter++;
				 $total_sum+=$k["STUDENT_COUNT"];
		}
		?>	
			</tr>
			<tr>
			<td></td><td></td><td><strong class="pull-right" >TOTAL </strong></td><td><strong><?= number_format($total_sum) ;?></strong></td>
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
<style>
    table, table>thead>tr>th, table>tfoot>tr>th, table>tbody>tr>td {
        border: 1px solid #99979c !important;
    }
</style>
	

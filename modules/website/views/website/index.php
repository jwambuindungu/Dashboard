<?php
/* @var $this yii\web\View */
/* @var $chartdata array */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $start_date string */
/* @var $end_date string */
/* @var $intake_name string */

use \yii\helpers\Url;
use \yii\helpers\Html;

\app\assetmanager\FusionChartAsset::register($this);

$this->title = 'Website Reports';

?>

<div class="box box-primary text-center">
    <div class="box-header with-border">
        <h2 class="text-center">WEBOMETRICS REPORT: COLLEGE SUMMARY <?=$dates[0]['DATE']?>, Prev <?=$dates[1]['DATE']?></h2>
    </div>

    <div class="box-body">
        <table class="table table-bordered table-hover">
            <thead class="text-center text-primary">
                <tr>
                    <th rowspan="2" style="vertical-align: middle;">COLLEGE</th>
                    <th colspan="2" class='bg-warning'>PRESENCE</th>
                    <th colspan="2" class='bg-info'>BACKLINKS</th>
                    <th colspan="2" class='bg-warning'>DOMAINS</th>
                    <th colspan="2" class='bg-info'>CITATIONS</th>
                </tr>
                <tr>
                    <th class='bg-warning'>PREV</th>
                    <th class='bg-warning'>CURRENT</th>
                    <th class='bg-info'>PREV</th>
                    <th class='bg-info'>CURRENT</th>
                    <th class='bg-warning'>PREV</th>
                    <th class='bg-warning'>CURRENT</th>
                    <th class='bg-info'>PREV</th>
                    <th class='bg-info'>CURRENT</th>
                </tr>
            </thead>
            <tbody class="text-right">
            <?php
            $tp_pres=$tp_back=$tp_dom=$tp_cit=0;
            $tc_pres=$tc_back=$tc_dom=$tc_cit=0;
            foreach ($data as $r){
                $tp_pres+=$r['PREV_PRESENCE'];$tp_back+=$r['PREV_BACKLINKS'];$tp_dom+=$r['PREV_DOMAINS'];$tp_cit+=$r['PREV_CITATIONS'];
                $tc_pres+=$r['CURR_PRESENCE'];$tc_back+=$r['CURR_BACKLINKS'];$tc_dom+=$r['CURR_DOMAINS'];$tc_cit+=$r['CURR_CITATIONS'];
                echo '<tr>';
                echo "<th>{$r['COLLEGE']}</th>";
                echo "<td class='bg-warning'>".number_format($r['PREV_PRESENCE'])."</td>";
                echo "<td class='bg-warning'>".number_format($r['CURR_PRESENCE'])."</td>";
                echo "<td class='bg-info'>".number_format($r['PREV_BACKLINKS'])."</td>";
                echo "<td class='bg-info'>".number_format($r['CURR_BACKLINKS'])."</td>";
                echo "<td class='bg-warning'>".number_format($r['PREV_DOMAINS'])."</td>";
                echo "<td class='bg-warning'>".number_format($r['CURR_DOMAINS'])."</td>";
                echo "<td class='bg-info'>".number_format($r['PREV_CITATIONS'])."</td>";
                echo "<td class='bg-info'>".number_format($r['CURR_CITATIONS'])."</td>";
                echo '</tr>';
            }
            ?>
            </tbody>
            <tfoot class="text-right text-primary">
                <tr class="text-right">
                    <th>TOTAL</th>
                    <th class="text-right bg-warning"><?=number_format($tp_pres)?></th>
                    <th class="text-right bg-warning"><?=number_format($tc_pres)?></th>
                    <th class="text-right bg-info"><?=number_format($tp_back)?></th>
                    <th class="text-right bg-info"><?=number_format($tc_back)?></th>
                    <th class="text-right bg-warning"><?=number_format($tp_dom)?></th>
                    <th class="text-right bg-warning"><?=number_format($tc_dom)?></th>
                    <th class="text-right bg-info"><?=number_format($tp_cit)?></th>
                    <th class="text-right bg-info"><?=number_format($tc_cit)?></th>
                </tr>
            </tfoot>
        </table>
    </div>
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
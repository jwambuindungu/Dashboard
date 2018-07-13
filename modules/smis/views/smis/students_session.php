<?php
/* @var $this yii\web\View */

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\modules\smis\models\SMIS;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

\app\assetmanager\FusionChartAsset::register($this);

?>

<div>
    <table class="table">
        <thead>
            <tr>
                <th>COLLEGE CODE</th>
                <th>COLLEGE NAME</th>
                <th>REGISTERED</th>
                <th>NOT REGISTERED</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
        <?php
//        foreach($data as $r){
//            echo '<tr>';
//            echo "<td>{$r['COL_CODE']}</td>";
//            echo "<td>{$r['COLLEGE_NAMES']}</td>";
//            echo "<td>{$r['NOT_REGISTERED']}</td>";
//            echo "<td>{$r['REGISTERED']}</td>";
//            echo "<td>{$r['TOTAL_STUDENTS']}</td>";
//            echo '</tr>';
//        }
        foreach($data as $r){
            echo '<tr>';
            echo "<td>{$r['COL_CODE']}</td>";
            echo "<td>{$r['SUM_AMOUNTS']}</td>";
            echo "<td>{$r['COL_CODE']}</td>";
            echo "<td>{$r['SUM_AMOUNTS']}</td>";
            echo "<td>{$r['COL_CODE']}</td>";
            echo '</tr>';
        }
        ?>
        </tbody>
        <tfoot></tfoot>
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

<style>
    table, table>thead>tr>th, table>tfoot>tr>th, table>tbody>tr>td {
        border: 1px solid #99979c !important;
    }
</style>
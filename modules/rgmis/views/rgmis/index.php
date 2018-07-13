<?php
/* @var $this yii\web\View */

$dt2 = \app\modules\rgmis\models\RGMIS::GET_GRANTINCOME();
$dt = \app\modules\rgmis\models\RGMIS::GET_RECEIVED_GRANT();
?>

<div class="row">
<div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h4><?=number_format($totalgrant,2)?></h4>

                <p>Ongoing Projects Value</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
	<div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h4><?=number_format($overhead,2)?></h4>

                <p>Administration Cost</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
<div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h4><?=number_format($pi_grant,2)?></h4>

                <p>PI Share</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

<!-- ./col -->

<!-- ./col -->

<!-- ./col -->
 <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h4><?=number_format(($overhead/$totalgrant)*100,2)?><sup style="font-size: 20px">%</sup></h4>

                <p>Percentage Admin Cost</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<!-- ./col -->

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i>Percentage Grant Awards Per College
            </div>
            <div class="panel-body">
                <?= $this->render('@app/modules/rgmis/views/rgmis/collegegrantstatus', ['data' => $dt]); ?>
            </div>
        </div>
    </div>
	
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i>Overal University Grant Income
            </div>
            <div class="panel-body">
                <?= $this->render('@app/modules/rgmis/views/rgmis/collegegrantstatusuni', ['data' => $dt2]); ?>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->

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
<?php
/* @var $this yii\web\View */
use \app\modules\uspas\models\USPAS;

$dt = USPAS::GET_APPRAISED_STAFF();
$dt2 = USPAS::GET_APPRAISED_STAFFOVERAL();

$y = USPAS::APPRAISAL_YEARLIST();
//            print_r($y);exit;
$yr = $y[0]['yr'];
use \yii\helpers\Url;
use yii\helpers\Html;

?>


<div class="row">
<div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
            <div class="inner">
                <h3><?=$appraisees?></h3>

                <p>Total staff set for Appraisal</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
           <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
        </div>
    </div>
	<div class="col-lg-2 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?=$appraised?></h3>

                <p>Total Staff Appraised</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <!--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
        </div>
    </div>
<div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?=number_format((100-($appraised/$appraisees)*100),2)?><sup style="font-size: 20px">%</sup></h3>

                <p>Percentage Not Appraised</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
           <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
        </div>
    </div>

<!-- ./col -->

<!-- ./col -->

<!-- ./col -->
 <div class="col-lg-2 col-xs-6">
 
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
			
                <h3><?=number_format(($appraised/$appraisees)*100,2)?><sup style="font-size: 20px">%</sup></h3>

                <p>Percentage  Appraised</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
           <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
        </div>
    </div>
	<div class="col-lg-2 col-xs-6">
 
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
			
                <h3><?=$neverAppraised?></h3>

                <p>Staff Never Appraised</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
           <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
        </div>
    </div>
</div>
<!-- ./col -->




<!--
end of 

-->
<div align="left" class="row">
        <div class="col-md-2">

            <!-- Calendar -->
            <div class="box box-solid bg-yellow-gradient">
                <div class="box-header">
                    <i class="fa fa-link"></i>

                    <h3 class="box-title">Quick Links</h3>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-warning btn-sm" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /. tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="list-group" style="width: 100%">
					
					
                    <?php //if((count(array_intersect(['HRMIS_ADMIN'],$role)))):?>
                        
                    <?php //endif; ?>
					
					<?= Html::a('College Appraisal Progress ', ['//uspas/uspas/appraisalstatus'], ['class' => 'list-group-item']) ?>
					<?= Html::a('Appraisal Status Per College ', ['//uspas/uspas/appraisalstatust'], ['class' => 'list-group-item']) ?>
					<?= Html::a('University Appraisal Status ', ['//uspas/uspas/appraisalstatusuni'], ['class' => 'list-group-item']) ?>
					<?= Html::a('My college Appraisal ', ['//uspas/uspas/collegedeptspie'], ['class' => 'list-group-item']) ?>
					<?= Html::a('My Departments Appraisal ', ['//uspas/uspas/collegedeptstatust'], ['class' => 'list-group-item']) ?>
					<?= Html::a('My Department Appraisal ', ['//uspas/uspas/mydeptstatus'], ['class' => 'list-group-item']) ?>
					
                        
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        
     <!--   </div>
<div class="row">-->


    <div class="col-md-5">
	
        <div class="panel panel-default">
		
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i>Appraisal By College
            </div>
            <div class="panel-body">
                <?= $this->render('@app/modules/uspas/views/uspas/collegeappraisalstatus', ['data' => $dt,'yr'=>$yr,'range'=>0]); ?>
            </div>
        </div>
    </div>
	
    <div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i>Overall University Appraisal Status
            </div>
            <div class="panel-body">
                <?= $this->render('@app/modules/uspas/views/uspas/collegeappraisalstatusuni', ['data' => $dt2,'yr'=>$yr]); ?>
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
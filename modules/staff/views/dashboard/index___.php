<?php
/* @var $this yii\web\View */
/* @var $chartdata array */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $start_date string */
/* @var $end_date string */
/* @var $intake_name string */

use enscope\Yii2ChartJs\ChartJsWidget;
use \yii\helpers\Url;
use \yii\helpers\Html;

$this->title = 'Staff Datapool';

// $this->params['breadcrumbs'][] = $this->title;

?>
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-md-3">
		<div class="col-lg-10 col-md-10">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-users fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge"><?=$st?></div>
							<div>Staff</div>
						</div>
					</div>
				</div>
			</div>
        </div>
		<div class="col-lg-2 col-md-2">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-users fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge"><?=$st?></div>
							<div>Staff</div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-lg-pull-1 col-xs-pull-1">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-book fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?=$ts?></div>
                        <div>Teaching Staff</div>
                    </div>
                </div>
            </div>
			<!-- 
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
			-->
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?=$nts?></div>
                        <div>Non-Teaching Staff</div>
                    </div>
                </div>
            </div>
			<!-- 
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
			-->
        </div>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> STAFF POPULATION
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="row">
				
				
					<div class="col-md-6">
						<div class="panel panel-info">
							<div class="panel-heading">
								<i class="fa fa-venus-mars fa-fw"></i> Gender Distribution per College
							</div>
							<!-- /.panel-heading -->
							<div class="panel-body">
								<?= ChartJsWidget::widget([
									'chartType' => ChartJsWidget::CHART_BAR,
									'canvasOptions' => [
										'height' => 800
									],
									'chartOptions' => [
										'animation' => false,
										'bezierCurve' => false,
										'maintainAspectRatio' => false,
										'responsive' => true,
										'tooltips' => [
											'callbacks' => [
												'label' => ChartJsWidget::js('function (item) { return (item.yLabel); }')
											]
										],
										'legend' => [
											'display' => true,
											'position' => 'bottom'
										]
									],
									'chartData' => $chartdata
								]) ?>
							</div>
							<!-- /.panel-body -->
						</div>
						<!-- /.panel -->
						
					</div>
					<div class="col-md-6">
						<div class="panel panel-info">
							<div class="panel-heading">
								<i class="fa fa-users fa-fw"></i> Staff Population per College
							</div>
							<!-- /.panel-heading -->
							<div class="panel-body">
								<?= ChartJsWidget::widget([
									'chartType' => ChartJsWidget::CHART_PIE,
									'canvasOptions' => [
										'height' => 800
									],
									'chartOptions' => [
										'animation' => false,
										'bezierCurve' => false,
										'maintainAspectRatio' => false,
										'responsive' => true,
										'title' => [
											'display' => true,
											'text' => 'Legend',
											'position' => 'bottom'
										],
										'legend' => [
											'display' => true,
											'position' => 'bottom'
										]
									],
									'chartData' => $piedata
								]) ?>
							</div>
							<!-- /.panel-body -->
						</div>
						<!-- /.panel -->
					</div>
				
				
				</div>
				<!-- /.panel-STAFF POPULATION -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
	</div>
</div>

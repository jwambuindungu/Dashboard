<?php
/* @var $this yii\web\View */

use \yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Human Resource';
?>
	<!-- Nugget row -->
	<div align="center" class="row lug dtTupple">
        <i class="fa fa-refresh fa-spin text-info" style="font-size:50px"></i>
	</div>
    <!-- Main row -->
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
                        <?= Html::a('Staff on Leave', ['//leave'], ['class' => 'list-group-item']) ?>
                        <?= Html::a('Age Distribution', ['//age'], ['class' => 'list-group-item']) ?>
                        <?= Html::a('Gender & Designation', ['//staffing'], ['class' => 'list-group-item']) ?>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <section class="col-lg-5 connectedSortable set1 dtTupple">
            <i class="fa fa-refresh fa-spin text-info" style="font-size:254px"></i>
        </section>
        <section class="col-lg-5 connectedSortable set2 dtTupple">
            <i class="fa fa-refresh fa-spin text-info" style="font-size:254px"></i>
        </section>
        </div>
    </div>
    <!-- /.row (main row) -->

<script>
$(function () {

  "use strict";
  
  //Make the dashboard widgets sortable Using jquery UI
	$(".connectedSortable").sortable({
		placeholder: "sort-highlight",
		connectWith: ".connectedSortable",
		handle: ".box-header, .nav-tabs",
		forcePlaceholderSize: true,
		zIndex: 999999
	});
	$(".connectedSortable .box-header, .connectedSortable .nav-tabs-custom").css("cursor", "move");
  
});
$(document).ready(function(){ });
</script>

<?php
$rPu = Url::to(['/staff/control/profgenderdonut-ajax']);
$rGu = Url::to(['/staff/control/staffgendergraph-ajax']);
$rNu = Url::to(['/staff/control/staffnuggets-ajax']);
$rLs = Url::to(['/staff/control/release-ajax']);
$script = <<< JS
// bind a function to the window closing
$(window).bind("beforeunload", function(){
	$.get('$rLs');
});

// $.ajax({'url':'$rNu', 'success': function(d){ $('.lug').html(d);}});
$.get('$rNu', function(d){ $('.lug').html(d);})
    .fail(function(XMLHttpRequest, textStatus, errorThrown){ 
        $('.lug').html('<h4 class="text-danger">Error:' + XMLHttpRequest.status + 
         '<br/>Could not Display Nuggets</h4>');
    });
$.get('$rGu', function(d){ $('.set1').html(d);})
    .fail(function(XMLHttpRequest, textStatus, errorThrown){ 
        $('.lug').html('<h4 class="text-danger">Error:' + XMLHttpRequest.status + 
         '<br/>Could not Display Nuggets</h4>');
    });
$.get('$rPu', function(d){ $('.set2').html(d);})
    .fail(function(XMLHttpRequest, textStatus, errorThrown){ 
        $('.lug').html('<h4 class="text-danger">Error:' + XMLHttpRequest.status + 
         '<br/>Could not Display Nuggets</h4>');
    });
JS;
$this->registerJs($script, \yii\web\View::POS_READY);
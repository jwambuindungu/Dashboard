<?php
use yii\helpers\Html;


$dashboard_url = \yii\helpers\Url::toRoute(['//dashboard']);
$role = Yii::$app->session->get('roles');
$ac_roles = Yii::$app->params['ac_roles'];
$stud = $ac_roles['student'];
$fin =  $ac_roles['finance'];
$hr =   $ac_roles['hr'];
$web =  $ac_roles['web'];
$res =  $ac_roles['research'];
$adm =  $ac_roles['admin'];
$hod =  $ac_roles['hod'];
$prin = $ac_roles['principal'];

?>
<header class="main-header">
    <!-- Logo -->
    <a href="<?= $dashboard_url ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>M</b>D</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>MGMT</b> Dashboard</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div><h3 class="text-center"><b class="text-white"><?= Yii::$app->name ?></b></h3></div>
    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <!--<li class="header">MAIN NAVIGATION</li>-->
            <li class="header"><?= Html::a(Html::encode(strtoupper($this->title)), ['//dashboard'], ['class' => '']) ?></li>
            <?php if((count(array_intersect($stud,$role)))):?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Students</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><?= Html::a('Dashboard', ['//smis-dashboard'], ['class' => '']) ?></li><li>
                        <?= Html::a('Application Analysis', ['//smis/smis/postgrad-intake'], ['class' => '']) ?></li>
                    <li><?= Html::a('Application', ['//student-reports'], ['class' => '']) ?></li>
                    <!-- <li><?= Html::a('Fee Collection', ['//fee-collection'], ['class' => '']) ?></li> -->
                    <li><?= Html::a('Enrollment Statistics', ['//nominal-roll'], ['class' => '']) ?></li>
                </ul>
            </li>
            <?php endif; ?>
            <?php if((count(array_intersect($hr,$role)))):?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Human Resource</span>
                    <span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
                </a>
                <ul class="treeview-menu">
                    <li><?= Html::a('Dashboard', ['//staff-reports'], ['class' => '']) ?></li>
                    <li><?= Html::a('Staff on Leave', ['//leave'], ['class' => '']) ?></li>
                    <li><?= Html::a('Age Distribution', ['//age'], ['class' => '']) ?></li>
                    <li><?= Html::a('Gender & Designation', ['//staffing'], ['class' => '']) ?></li>
<!--                    <li class="dropdown-header">Appraisal</li>-->
                    <li><?= Html::a('Appraisal Summary', ['//uspas'], ['class' => '']) ?></li>
                    <li><?= Html::a('College Appraisal Progress ', ['//uspas/uspas/appraisalstatus'], ['class' => '']) ?></li>
                    <li><?= Html::a('Appraisal Status Per College ', ['//uspas/uspas/appraisalstatust'], ['class' => '']) ?></li>
                    <li><?= Html::a('University Appraisal Status ', ['//uspas/uspas/appraisalstatusuni'], ['class' => '']) ?></li>
                    <?php //if((count(array_intersect(['HRMIS_ADMIN'],$role)))):?>
                        <li><?= Html::a('My college Appraisal ', ['//uspas/uspas/collegedeptspie'], ['class' => '']) ?></li>
                        <li><?= Html::a('My Departments Appraisal ', ['//uspas/uspas/collegedeptstatust'], ['class' => '']) ?></li>
                    <?php //endif; ?>
					<li><?= Html::a('My Department Appraisal ', ['//uspas/uspas/mydeptstatus'], ['class' => '']) ?></li>
					
<!--                    <li class="dropdown-header">Health Services</li>-->
                </ul>
            </li>
            <?php endif; ?>
            <?php if((count(array_intersect($adm,$role)))):?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Administration</span>
                    <span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
                </a>
                <ul class="treeview-menu">
<!--                    <li><?//= Html::a('Dashboard', 'javascript:void(0);', ['class' => '']) ?></li>-->
<!--                    <li class="dropdown-header">Transport</li>-->
                    <li><?= Html::a('Vehicle Repair Costs', ['//repair-costs'], ['class' => '']) ?></li>
                    <li><?= Html::a('Annual Vehicle Repair Costs', ['//annual-repair-costs'], ['class' => '']) ?></li>
                </ul>
            </li>
            <?php endif; ?>
            <?php if((count(array_intersect($fin,$role)))):?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Finance</span>
                    <span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
                </a>
                <ul class="treeview-menu">
                    <li><?= Html::a('Dashboard', ['//finance-reports'], ['class' => '']) ?></li>
                    <li><?= Html::a('Budget', ['//budget'], ['class' => '']) ?></li>
                    <li><?= Html::a('Salaries', ['//control-summary'], ['class' => '']) ?></li>
<!--                    <li class="dropdown-header">Grants</li>-->
                   <!--   <li><?//= Html::a('Grant Income', ['//rgmis/rgmis/grantstatusuni'], ['class' => '']) ?></li>-->
					<li><?= Html::a('Total Grants Per Year', ['//rgmis/rgmis/annualgrants'], ['class' => '']) ?></li>
					<li><?= Html::a('Total Admin Costs Per Year', ['//rgmis/rgmis/annualadmincosts'], ['class' => '']) ?></li>
                </ul>
            </li>
            <?php endif; ?>
            <?php if((count(array_intersect($res,$role)))):?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Research</span>
                    <span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
                </a>
                <ul class="treeview-menu">
                    <li><?= Html::a('Ongoing Research', ['//rgmis/rgmis/grantstatus'], ['class' => '']) ?></li>
					 <li><?= Html::a('Grants Per College', ['//rgmis/rgmis/annualgrantpercollege'], ['class' => '']) ?></li>
					 <li><?= Html::a('Admin Costs Per College', ['//rgmis/rgmis/annualadmincostpercollege'], ['class' => '']) ?></li>
					 <li><?= Html::a('Total Grants Per Year', ['//rgmis/rgmis/annualgrants'], ['class' => '']) ?></li>
					 <li><?= Html::a('Total Admin Costs Per Year', ['//rgmis/rgmis/annualadmincosts'], ['class' => '']) ?></li>
                </ul>
            </li>
            <?php endif; ?>
            <?php if((count(array_intersect($web,$role)))):?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Webometrics</span>
                    <span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
                </a>
                <ul class="treeview-menu">
                    <li><?= Html::a('Webometrics', ['//webometric-report'], ['class' => '']) ?></li>
                </ul>
            </li>
            <?php endif; ?>

            <?= Html::beginForm(['/site/logout'], 'post') ?>
            <li><?= Html::submitButton('Logout (' . Yii::$app->user->id . ')', ['class' => 'btn btn-link logout']) ?></li>
            <?= Html::endForm() ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

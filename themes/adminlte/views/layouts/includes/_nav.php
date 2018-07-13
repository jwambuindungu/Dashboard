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
                       <li> <?= Html::a('Application Analysis ', ['//smis/smis/postgrad-intake'], ['class' => '']) ?></li>
						<li><?= Html::a('Fees Collections', ['//smis/smis/periodicallfees'], ['class' => '']) ?></li>
						<li><?= Html::a('Foreign Students', ['//smis/smis/foreignstudents'], ['class' => '']) ?></li>
						<li><?= Html::a('Graduands with Balances', ['//smis/smis/graduandsbalances'], ['class' => '']) ?></li>
						<li><?= Html::a('Graduands Per Category', ['//smis/smis/graduands'], ['class' => '']) ?></li>
						<li><?= Html::a('Application', ['//student-reports'], ['class' => '']) ?></li>
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
                    <li><?= Html::a('Personnel', ['//staff-reports'], ['class' => '']) ?></li>
                    <li><?= Html::a('Appraisal', ['//uspas'], ['class' => '']) ?></li>
					<!--<li class="dropdown-header">Appraisal</li>-->
                    
                    
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
					<li><?= Html::a('Fees Collections', ['//smis/smis/periodicallfees'], ['class' => '']) ?></li>
					<li><?= Html::a('Graduands with Balances', ['//smis/smis/graduandsbalances'], ['class' => '']) ?></li>
                    <li><?= Html::a('Salaries', ['//control-summary'], ['class' => '']) ?></li>
<!--                    <li class="dropdown-header">Grants</li>-->
                   <!--   <li><?= Html::a('Grant Income', ['//rgmis/rgmis/grantstatusuni'], ['class' => '']) ?></li>-->
					<li><?= Html::a('Total Grants Per Year', ['//rgmis/rgmis/annualgrants'], ['class' => '']) ?></li>
					<li><?= Html::a('Total Admin Costs Per Year', ['//rgmis/rgmis/annualadmincosts'], ['class' => '']) ?></li>
                </ul>
            </li>
			
			<!-- 
			  <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Multilevel</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                    <li>
                      <a href="#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
              </ul>
            </li> -->
			
			
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
            <li>
                <?= Html::beginForm(['/site/logout'], 'post') ?>
                <?= Html::a('<i class="fa fa-fw fa-lock"></i> Logout (' . Yii::$app->user->id . ')',
                    'javascript:void(0);',
                    ['class' => 'btn btn-black', 'title' => 'Log Out', 'onclick' => '$(this).closest("form").submit();']
                ); ?>
                <?= Html::endForm() ?>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

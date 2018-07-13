<?php

namespace app\modules\staff\controllers;

use app\modules\staff\models\STAFF_STUFF;
use app\modules\staff\models\DATA;
use yii\filters\AccessControl;

// use  yii\web\Application;

class StaffController extends \yii\web\Controller
{
    private $user_roles;

    public function behaviors()
    {
        $def = ['VC_ROLE','COLLEGE_PRINCIPAL']; // Default for All Actions
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                    ['actions'=>['index',],'allow' => true,'roles' => ['@'],],
                    [
                        'actions'=>['budget',],
                        'allow' => ((count(
                            array_intersect(array_merge($def,['FINANCE_OFFICER_ROLE',]),
                                $this->user_roles)
                            ))?1:0),
                        'roles' => ['@'],
                    ],
                    [
                        'actions'=>['collegeposstatus',],
                        'allow' => ((count(
                            array_intersect(array_merge($def,['DVC_AF_ROLE',]),
                                $this->user_roles)
                            ))?1:0),
                        'roles' => ['@'],
                    ],
                    [
                        'actions'=>['collegeage',],
                        'allow' => ((count(
                            array_intersect(array_merge($def,['DVC_AF_ROLE',]),
                                $this->user_roles)
                            ))?1:0),
                        'roles' => ['@'],
                    ],
                    [
                        'actions'=>['staff-on-leave',],
                        'allow' => ((count(
                            array_intersect(array_merge($def,['DVC_AF_ROLE',]),
                                $this->user_roles)
                            ))?1:0),
                        'roles' => ['@'],
                    ],
                    [
                        'actions'=>['collegestaff',],
                        'allow' => ((count(
                            array_intersect(array_merge($def,['DVC_AF_ROLE',]),
                                $this->user_roles)
                            ))?1:0),
                        'roles' => ['@'],
                    ],
                    [
                        'actions'=>['controlsummary',],
                        'allow' => ((count(
                            array_intersect(array_merge($def,['DVC_AF_ROLE','REGISTRAR_PLANNING_ROLE','FINANCE_OFFICER_ROLE',]),
                                $this->user_roles)
                            ))?1:0),
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        $this->user_roles = \Yii::$app->session->get('roles');
        $this->user_roles = empty($this->user_roles)?[]:$this->user_roles;
        return parent::beforeAction($action);
    }

    public function actionBudget()
    {
		$rsdt = [];
		$y = date('Y');
		if(isset($_GET['y'])){
			$y = $_GET['y'];
		}
		if(isset($_GET['C'])){
			$colName = DATA::ABBR_CNAME(STAFF_STUFF::GETCOL(@$_GET['C']),false);
			$dt = STAFF_STUFF::GET_VBUDGET($_GET['C'],$y);
			$rsdt['data']=$dt;
			$rsdt['colName']=$colName;
		}else{
			$dt = STAFF_STUFF::GET_BUDGET($y);
			$rsdt['data']=$dt;
		}
		$rsdt['yrList']=STAFF_STUFF::YEARLIST();
		$rsdt['y']=$y;
		$rsdt['lvl2']=$rsdt;
		
		return $this->render('budgetary',$rsdt);
		// return 1;
    }
	
    public function actionCollegeposstatus()
    {
		$rsdt = [];
		
		$dt = STAFF_STUFF::GET_POS_STATS_COL();
		$rsdt['data']=$dt;
		
		return $this->render('pos_status',$rsdt);
		// return 1;
    }
	
    public function actionCollegeage()
    {
		$rsdt = [];
		
		if(isset($_GET['C'])){
			$colName = DATA::ABBR_CNAME(STAFF_STUFF::GETCOL(@$_GET['C']),false);
			$dt = STAFF_STUFF::GET_DEPT_ABRACKET($_GET['C']);
			$dtT = STAFF_STUFF::GET_DEPT_ABRACKETT($_GET['C']);
			$rsdt['data']=$dt;
			$rsdt['dataT']=$dtT;
			$rsdt['colName']=$colName;
		}else{
			$dt 	= STAFF_STUFF::GET_COL_ABRACKET();
			$dtT 	= STAFF_STUFF::GET_COL_ABRACKETT();
			$dtG 	= DATA::BUILD_CAGES();
			$rsdt['graphdata']=json_encode($dtG);
			$rsdt['data']=$dt;
			$rsdt['dataT']=$dtT;
		}
		
		$rsdt['lvl2']=$rsdt;
		
		return $this->render('age_bracket',$rsdt);
		// return 1;
    }

    public function actionStaffOnLeave()
    {
		$rsdt = [];

        if(isset($_GET['C'])){
            $colName = DATA::ABBR_CNAME(STAFF_STUFF::GETCOL(@$_GET['C']),false);
            $dt = STAFF_STUFF::GET_DEPT_SOLEAVE($_GET['C']);
            $rsdt['data']=$dt;
            $rsdt['colName']=$colName;
        }else{
            $dt 	= STAFF_STUFF::GET_COL_SOLEAVE();
            $dtG 	= DATA::BUILD_SoL();
            $rsdt['data']=$dt;
            $rsdt['graphdata']=json_encode($dtG);
        }
		$rsdt['lvl2']=$rsdt;

		return $this->render('staffOnLeave',$rsdt);
    }
	
    public function actionCollegestaff()
    {
		// $rq = Yii::$app->request;
		// $col = $rq->get('C');BUILD_SCATS
		$rsdt = [];
		if(isset($_GET['C'])){
			$colName = DATA::ABBR_CNAME(STAFF_STUFF::GETCOL(@$_GET['C']));
			$t = (isset($_GET['T']))?$_GET['T']:'NT';
			$d = (isset($_GET['G']))?$_GET['G']:'';
			if($d!=''){
				$grade=STAFF_STUFF::GETGRADE($d);
				$rsdt['grade']=$grade;
				$dt = STAFF_STUFF::GET_GRADE_STAFF($_GET['C'],$d,$t);
			}else{
				$dt = STAFF_STUFF::GET_DESG_SEX($_GET['C'],$t);
			}
			$rsdt['data']=$dt;
			$rsdt['tstat']=($t=='T')?'TEACHING STAFF':($t=='P')?'PROJECT STAFF':'NON-TEACHING STAFF';
			$rsdt['colName']=$colName;
		}else{
			$dtG= DATA::BUILD_SCATS();
			$rsdt['graphdata']=json_encode($dtG);
			$dt = STAFF_STUFF::GET_COL_STAFF();
			$rsdt['data']=$dt;
		}
		
		return $this->render('collegestaff',$rsdt);
		// return 1;
    }
	
	private function getPrev($prdcode){
		// Get Previous Period Code
		$perdD = explode('/',$prdcode);
		$pdMon = $perdD[0];
		$pdYr = $perdD[1];
		$subYr = substr($pdYr, 2, 1);
		$prevM = (int)$pdMon-1;
		$prevY = $pdYr;
		if($prevM<=0){
			$prevM = 12;
			$prevY--;
		}
		if($prevY<0){
			$prevM = 12;
			$prevY=100+$prevY;
		}
		$prevM = str_pad($prevM, 2, "0", STR_PAD_LEFT);
		$prevY = str_pad($prevY, 2, "0", STR_PAD_LEFT);
		return $prevM.'/'.$prevY.''.$subYr;
	}
	
	private function setStartP($prdcode){
		// Get Previous Period Code
		$rs = STAFF_STUFF::GETDEFAULTPRD($prdcode);
		if(empty($rs))
			$rs=$this->getPrev($prdcode);
		return $rs;
	}
	
    public function actionControlsummary()
    {

		$listPrd = STAFF_STUFF::LISTPERIODS();
		$rsdt = [];
		$rsdt['periods'] = $listPrd;
		
		$prdcode = "";
		$prdcode = (!empty($_REQUEST['prdcode'])) ? $_REQUEST['prdcode'] : "";
		   
		$prdcode = rtrim($prdcode);
		if(empty($prdcode))
			$prdcode=date('m/y');
		$prdcode = $this->setStartP($prdcode);
		$prd1 = $this->getPrev($prdcode);
		$prd2 = $this->getPrev($prd1);

//        print_r($prd1); exit;
		
		$rsdt['prdcode'] = $prdcode;
		
		$period = STAFF_STUFF::GETPERIOD($prdcode);
		$pd = explode('/',$prdcode);
		$pm = $pd[0]; $py = $pd[1];
		$pd1 = explode('/',$prd1);
		$pm1 = $pd1[0]; $py1 = $pd1[1];
		$pd2 = explode('/',$prd2);
		$pm2 = $pd2[0]; $py2 = $pd2[1];
		
		$prds = [];
		$tltp = [];
		
		$prds[]=['m'=>$pm,'y'=>$py];
		$prds[]=['m'=>$pm1,'y'=>$py1];
		$prds[]=['m'=>$pm2,'y'=>$py2];
		$rsdt['pdp']=$prds;
		
		$tltp[]=strtoupper($this->getFullMnth($pm2)).' '.$this->getFullYr($py2);
		$tltp[]=strtoupper($this->getFullMnth($pm1)).' '.$this->getFullYr($py1);
		$tltp[]=strtoupper($this->getFullMnth($pm)).' '.$this->getFullYr($py);
		$rsdt['titP']=$tltp;

//		print_r($tltp); exit;
	   
		$dt = STAFF_STUFF::GETSUMPRD($prdcode,$prd1,$prd2);
		$prdTit = STAFF_STUFF::GETPRDTITLE($prdcode);
		$rsdt['prdTit']=$prdTit;
		$rsdt['data']=$dt;
		$graphdata = json_encode(DATA::BUILD_VCS($prdcode));
		$rsdt['graphdata']=$graphdata;
		
		$rsdt['lvl2']=$rsdt;
		
		return $this->render('controlsummary',$rsdt);
    }
	
	private function getFullYr($shortYr){
		return date("Y", mktime(0, 0, 0, 1, 1, (int)$shortYr));
	}
	private function getFullMnth($shortMnth){
		return date("F", mktime(0, 0, 0, (int)$shortMnth, 1, 99));
	}
	private function reFormatNum($str){
		return floatval(str_replace(',', '', $str));
	}
	
//	public function actionSomething() {
//		$sexes = ['M'=>'Male', 'F'=>'Female'];
//		$this->render('yourView', ['sexes'=>$sexes]);
//	}

    public function actionIndex()
    {

//		return $this->redirect(['//staff-reports']);
		return $this->render('index',['r'=>$this->user_roles]);
    }
}
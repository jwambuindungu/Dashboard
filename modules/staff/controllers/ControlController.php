<?php

namespace app\modules\staff\controllers;

use app\modules\rgmis\models\RGMIS;
use app\modules\staff\models\DATA;
use app\modules\student\models\FEE_REPORT_MODEL;
use app\modules\student\models\NOMINAL_ROLL_MODEL;
use app\modules\uspas\models\USPAS;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class ControlController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    public function actionStaffnuggets()
    {
		
        $staffC 	= DATA::GET_POP();
        $staffTS 	= DATA::GET_POPTS();
        $staffNTS 	= DATA::GET_POPNTS();
        $staffP 	= DATA::GET_POPPS();
        $term 		= DATA::GET_ETERMS();
        $pos 		= DATA::GET_EPOS();
//        $prof 		= DATA::GET_PROFS();
        $retire 	= DATA::GET_RETIRECOUNT();

		return $this->render('nugget', [
		'st' 			=> $staffC,
            'ts' 			=> $staffTS,
            'nts' 			=> $staffNTS,
            'ps' 			=> $staffP,
            'retire' 		=> $retire,
			// POS Status
            'active' 		=> $pos['ACTIVE'],
            'absence' 		=> $pos['ABSENCE'],
//            'contract' 		=> $pos['CONTRACT'],
            'sabb' 			=> $pos['SABBATICAL'],
            'study' 		=> $pos['STUDY'],
            'leave' 		=> $pos['OTHER_LEAVE'],
            'second' 		=> $pos['SECONDED'],
            'suspend' 		=> $pos['SUSPENDED'],
			// Terms Status
            'permanent'		=> $term['PERMANENT'],
            'temp' 			=> $term['TEMPORARY'],
            'oncontract'	=> $term['CONTRACT'],
            'postret' 		=> $term['POST RETIREMENT'],]);
    }
    public function actionStaffnuggetsAjax()
    {
        $this->actionReleaseAjax();
//        $staffC 	= DATA::GET_POP();
//        $staffTS 	= DATA::GET_POPTS();
//        $staffNTS 	= DATA::GET_POPNTS();
//        $staffP 	= DATA::GET_POPPS();
        $term 		= DATA::GET_ETERMS();
        $pos 		= DATA::GET_EPOS();
//        $prof 		= DATA::GET_PROFS();
        $retire 	= DATA::GET_RETIRECOUNT();

		return $this->renderPartial('nugget_ajax', [
//		'st' 			=> $staffC,
//            'ts' 			=> $staffTS,
//            'nts' 			=> $staffNTS,
//            'ps' 			=> $staffP,
            'retire' 		=> $retire,
			// POS Status
            'active' 		=> $pos['ACTIVE'],
//            'absence' 		=> $pos['ABSENCE'],
//            'contract' 		=> $pos['CONTRACT'],
//            'sabb' 			=> $pos['SABBATICAL'],
//            'study' 		=> $pos['STUDY'],
//            'leave' 		=> $pos['OTHER_LEAVE'],
//            'second' 		=> $pos['SECONDED'],
//            'suspend' 		=> $pos['SUSPENDED'],
			// Terms Status
            'permanent'		=> $term['PERMANENT'],
            'temp' 			=> $term['TEMPORARY'],
            'oncontract'	=> $term['CONTRACT'],
            'postret' 		=> $term['POST RETIREMENT'],]);
    }

    public function actionDashnuggetsAjax()
    {
        $this->actionReleaseAjax();
        $term 		= DATA::GET_ETERMS();
        $pos 		= DATA::GET_EPOS();
        $retire 	= DATA::GET_RETIRECOUNT();
        // SPAS
        $y = USPAS::APPRAISAL_YEARLIST();
        $ayr = $y[0]['yr'];
        $sapp = USPAS::GET_APPRAISED_STAFF($ayr);
        /**/
        if(empty($sapp)){
            $ayr = $y[1]['yr'];
            $sapp = USPAS::GET_APPRAISED_STAFF($ayr);
        }
        
        $sapp1 = array_sum(ArrayHelper::getColumn($sapp,'APPRAISED'));
        $sapp = ($sapp1/array_sum(ArrayHelper::getColumn($sapp,'TOTAL')))*100;

//        if(empty($sapp)){ $sapp = 0;}
//        print_r($sapp);exit;
        // Students
        $stNom = NOMINAL_ROLL_MODEL::NOMINAL_AC_YEAR_DATA_TABLE(true);
        $stud_yr = $stNom[count($stNom)-1]['ACADEMIC_YEAR'];
        $stud_tot = ArrayHelper::getColumn($stNom,'SUB_TOTAL');
        $stud_tot = str_replace(',','',$stud_tot[count($stud_tot)-1]);
        $stFee = str_replace(',','',FEE_REPORT_MODEL::COLLEGE_SUMMARY_COLLECTIONS());

//        print_r(str_replace($stud_tot);exit;
        // Grants
        $grt = RGMIS::GET_GRANTINCOMECOMPARISON();
        $grant_tot = ArrayHelper::map($grt,'YEAR','TOTAL_BUDGET')[date('Y')];
        $grants_collect = ArrayHelper::map($grt,'YEAR','TOTAL_OVERHEAD_AMOUNT')[date('Y')];

		return $this->renderPartial('dashnugget_ajax', [
            'retire' 		=> $retire,
			// Terms Status
            'permanent'		=> $term['PERMANENT'],
            'temp' 			=> $term['TEMPORARY'],
            'oncontract'	=> $term['CONTRACT'],
            'postret' 		=> $term['POST RETIREMENT'],
            // Appraised
            'appraised' 	=> $sapp,'appraise_yr' 	=> $ayr,
            // Students
            'stud_tot' 	    => $stud_tot,'stud_yr' 	=> $stud_yr,
            'fee_today' 	=> $stFee,
            // Grant
            'grants' 	=> $grant_tot,'grant_yr' 	=> date('Y'),
            'grants_collect' 	=> $grants_collect,
        ]);
    }

    public function actionStaffgendergraph()
    {
        $dataBP 	= DATA::BUILD_CHART();

		return $this->render('staffgender_graph', [
            'colgendata'	=>json_encode($dataBP['graph'])
        ]);
    }

    public function actionStaffgendergraphAjax()
    {
        $this->actionReleaseAjax();
        $dataBP 	= DATA::BUILD_CHART();

		return $this->renderAjax('staffgender_graph', [
            'colgendata'	=>json_encode($dataBP['graph'])
        ]);
    }
    public function actionStaffcensusgraph()
    {
        $dataBG 	= DATA::BUILD_GRAPH();

		return $this->render('scensus_graph', [
            'colpopdata'	=>json_encode($dataBG['graph'])
        ]);
    }
    public function actionStaffcensusdonut()
    {
        $dataBG 	= DATA::BUILD_GRAPH();
		
        return $this->render('scensus_donut', [
            'colpopdataD'	=>json_encode($dataBG['donut'])
        ]);
    }
    public function actionControlsummarygraphAjax()
    {
        $this->actionReleaseAjax();
        $dataCS = DATA::BUILD_CS();
		
        return $this->renderPartial('ctrlsum_graph', [
            'ctrlsumdata'	=>json_encode($dataCS['graph']),
        ]);
    }
    public function actionControlsummarygraph()
    {
        $dataCS = DATA::BUILD_CS();

        return $this->render('ctrlsum_graph', [
            'ctrlsumdata'	=>json_encode($dataCS['graph']),
        ]);
    }
    public function actionProfgenderdonut()
    {
        $profD 		= DATA::DN_PROFS();
		
        return $this->render('profgender_donut', [
            'profgendata'	=>json_encode($profD['donut'])
        ]);
    }
    public function actionProfgenderdonutAjax()
    {
        $this->actionReleaseAjax();
        $profD 		= DATA::DN_PROFS();

        return $this->renderAjax('profgender_donut', [
            'profgendata'	=>json_encode($profD['donut'])
        ]);
    }
    public function actionReleaseAjax()
    {
        session_write_close();
        $this->session_reopen();
    }
    private function session_reopen()
    {
        ini_set('session.use_only_cookies', false);
        ini_set('session.use_cookies', false);
        //ini_set('session.use_trans_sid', false); //May be necessary in some situations
        ini_set('session.cache_limiter', null);
        session_start(); //Reopen the (previously closed) session for writing.
    }
}
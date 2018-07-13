<?php

namespace app\modules\staff\controllers;

use app\modules\staff\models\DATA;
use yii\web\Request;

class DashboardController extends \yii\web\Controller
{
    public function actionIndex()
    {
		// print_r(json_encode(DATA::BUILD_CS()));exit;
		// $this->view->title = 'Staff Stats';
        $dataBG 	= DATA::BUILD_GRAPH();
        $dataBP 	= DATA::BUILD_CHART();
        $dataCS 	= DATA::BUILD_CS();
        $staffC 	= DATA::GET_POP();
        $staffTS 	= DATA::GET_POPTS();
        $staffNTS 	= DATA::GET_POPNTS();
        $term 		= DATA::GET_ETERMS();
        $pos 		= DATA::GET_EPOS();
        $prof 		= DATA::GET_PROFS();
        $profD 		= DATA::DN_PROFS();
        $retire 	= DATA::GET_RETIRECOUNT();

		

        return $this->render('index', [
            'colpopdata'	=>json_encode($dataBG['graph']),
            'colpopdataD'	=>json_encode($dataBG['donut']),
            'colgendata'	=>json_encode($dataBP['graph']),
            'ctrlsumdata'	=>json_encode($dataCS['graph']),
            'profgendata'	=>json_encode($profD['donut']),
            'st' 			=> $staffC,
            'ts' 			=> $staffTS,
            'nts' 			=> $staffNTS,
            'retire' 		=> $retire,
			// POS Status
            'active' 		=> $pos['ACTIVE'],
            'absence' 		=> $pos['ABSENCE'],
            'contract' 		=> $pos['CONTRACT'],
            'leave' 		=> $pos['OTHER_LEAVE'],
            'second' 		=> $pos['SECONDED'],
            'suspend' 		=> $pos['SUSPENDED'],
			// Terms
            'permanent'		=> $term['PERMANENT'],
            'temp' 			=> $term['TEMPORARY'],
            'oncontract'	=> $term['CONTRACT'],
            'postret' 		=> $term['POST RETIREMENT'],
        ]);
		
    }
	
    public function actionFinance()
    {
        // $dataCS 	= DATA::BUILD_CS();
        $staffC 	= DATA::GET_POP();
        $staffTS 	= DATA::GET_POPTS();
        $staffNTS 	= DATA::GET_POPNTS();
        $retire 	= DATA::GET_RETIRECOUNT();

		

        return $this->render('finance', [
            // 'ctrlsumdata'	=>json_encode($dataCS['graph']),
            'st' 			=> $staffC,
            'ts' 			=> $staffTS,
            'nts' 			=> $staffNTS,
            'retire' 		=> $retire,
        ]);
		
    }
	
    public function actionIndex1()
    {
        $staffC 	= DATA::GET_POP();
        $staffTS 	= DATA::GET_POPTS();
        $staffNTS 	= DATA::GET_POPNTS();
        $staffP 	= DATA::GET_POPPS();
        $term 		= DATA::GET_ETERMS();
        $pos 		= DATA::GET_EPOS();
        $prof 		= DATA::GET_PROFS();
        $retire 	= DATA::GET_RETIRECOUNT();

		

        return $this->render('index_carousel', [
            'st' 			=> $staffC,
            'ts' 			=> $staffTS,
            'nts' 			=> $staffNTS,
            'ps' 			=> $staffP,
            'retire' 		=> $retire,
			// POS Status
            'active' 		=> $pos['ACTIVE'],
            'absence' 		=> $pos['ABSENCE'],
            'contract' 		=> $pos['CONTRACT'],
            'leave' 		=> $pos['OTHER_LEAVE'],
            'second' 		=> $pos['SECONDED'],
            'suspend' 		=> $pos['SUSPENDED'],
			// Terms Status
            'permanent'		=> $term['PERMANENT'],
            'temp' 			=> $term['TEMPORARY'],
            'oncontract'	=> $term['CONTRACT'],
            'postret' 		=> $term['POST RETIREMENT'],
			
        ]);
		
    }
}
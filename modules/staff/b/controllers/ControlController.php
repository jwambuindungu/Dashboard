<?php

namespace app\modules\staff\controllers;

use app\modules\staff\models\DATA;
use yii\web\Request;

class ControlController extends \yii\web\Controller
{
    public function actionStaffnuggets()
    {
		
        $staffC 	= DATA::GET_POP();
        $staffTS 	= DATA::GET_POPTS();
        $staffNTS 	= DATA::GET_POPNTS();
        $staffP 	= DATA::GET_POPPS();
        $term 		= DATA::GET_ETERMS();
        $pos 		= DATA::GET_EPOS();
        $prof 		= DATA::GET_PROFS();
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
            'contract' 		=> $pos['CONTRACT'],
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
    public function actionStaffgendergraph()
    {
        $dataBP 	= DATA::BUILD_CHART();

		return $this->render('staffgender_graph', [
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
}
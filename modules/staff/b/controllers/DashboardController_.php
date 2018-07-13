<?php

namespace app\modules\staff\controllers;

use app\modules\staff\models\DATA;
use yii\web\Request;

class DashboardController extends \yii\web\Controller
{
    public function actionIndex()
    {
		// $this->view->title = 'Staff Stats';
        $dataBG 	= DATA::BUILD_GRAPH();
        $dataBP 	= DATA::BUILD_PIE();
        $staffC 	= DATA::GET_POP();
        $staffTS 	= DATA::GET_POPTS();
        $staffNTS 	= DATA::GET_POPNTS();


        return $this->render('index', [
            'chartdata'	=> $dataBG,
            'piedata' 	=> $dataBP,
            'st' 		=> $staffC,
            'ts' 		=> $staffTS,
            'nts' 		=> $staffNTS,
        ]);
		
    }
}
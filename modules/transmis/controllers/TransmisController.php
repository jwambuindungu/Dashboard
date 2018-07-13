<?php

namespace app\modules\transmis\controllers;

use app\modules\transmis\models\TRANSMIS;
use yii\web\Request;

class TransmisController extends \yii\web\Controller
{
	public static function rq()
    {
        return Yii::$app->request;
    }
	
	
	public function actionRepaircosts($date_range='')
	{
	    $drange = [];
	    if(!empty($date_range)){
	        $drange = explode('~',strtoupper($date_range));
        }
		$dt=TRANSMIS::GET_REPAIRS_COSTS($drange);
		return $this->render('repaircosts',['data'=>$dt,'drange'=>$drange]);
	}
	/*public function actionYearlyrepaircosts($yr='')
    {
		 if(empty($yr)){
            $y = TRANSMIS::APPRAISAL_YEARLIST();
//            print_r($y);exit;
            $yr = $y[0]['yr'];
        }
		$dt = TRANSMIS::GET_REPAIRS_COSTS($yr);
		return $this->render('collegedeptstatust',['data'=>$dt,'yr'=>$yr,'range'=>1]);
    }
	
	*/
	public function actionAnnualrepaircosts($yr=''){
		 if(empty($yr)){
            $y = TRANSMIS::REPAIR_YEARLIST();
//            print_r($y);exit;
            $yr = $y[0]['yr'];
        }
		$dt = TRANSMIS::GET_ANNUAL_REPAIRS_COSTS($yr);
		return $this->render('annualrepaircosts',['data'=>$dt,'yr'=>$yr,'range'=>1]);
	}
    

}

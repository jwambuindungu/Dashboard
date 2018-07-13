<?php

namespace app\modules\uspas\controllers;

use app\modules\uspas\models\USPAS;
use yii\web\Request;

class UspasController extends \yii\web\Controller
{
	public static function rq()
    {
        return Yii::$app->request;
    }
	
    public function actionAppraisalstatus($yr='')
    {
        if(empty($yr)){
            $y = USPAS::APPRAISAL_YEARLIST();
//            print_r($y);exit;
            $yr = $y[0]['yr'];
        }
		$dt = USPAS::GET_APPRAISED_STAFF($yr);
		return $this->render('collegeappraisalstatus',['data'=>$dt,'yr'=>$yr,'range'=>1]);
    }
	
	 public function actionAppraisalstatusuni($yr='')
    {
		 if(empty($yr)){
            $y = USPAS::APPRAISAL_YEARLIST();
//            print_r($y);exit;
            $yr = $y[0]['yr'];
        }
		$dt = USPAS::GET_APPRAISED_STAFFOVERAL($yr);
		return $this->render('collegeappraisalstatusuni',['data'=>$dt,'yr'=>$yr,'range'=>1]);
    }
	
	public function actionAppraisalstatust($yr='')
    {
		 if(empty($yr)){
            $y = USPAS::APPRAISAL_YEARLIST();
//            print_r($y);exit;
            $yr = $y[0]['yr'];
        }
		$dt = USPAS::GET_APPRAISED_STAFF($yr);
		return $this->render('collegeappraisalstatust',['data'=>$dt,'yr'=>$yr,'range'=>1]);
    }
    public function actionIndex()
    {
		$dt = USPAS::GET_APPRAISED_STAFFOVERAL();
		foreach($dt as $k){
			$appraisees=$k["TOTAL"];
			$appraised=$k["APPRAISED"];
        }
        return $this->render('index',['appraisees'=>$appraisees,'appraised'=>$appraised]);
    }

}

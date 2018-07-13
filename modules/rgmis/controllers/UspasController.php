<?php

namespace app\modules\rgmis\controllers;

use app\modules\rgmis\models\RGMIS;
use yii\web\Request;

class RgmisController extends \yii\web\Controller
{
	public static function rq()
    {
        return Yii::$app->request;
    }
	
    public function actionGrantstatus()
    {
		$dt = RGMIS::GET_RECEIVED_GRANT();
		return $this->render('collegegrantstatus',['data'=>$dt]);
    }
	/*
	 public function actionAppraisalstatusuni()
    {
		$dt = USPAS::GET_APPRAISED_STAFFOVERAL();
		return $this->render('collegeappraisalstatusuni',['data'=>$dt]);
    }*/
    public function actionIndex()
    {
        return $this->render('index');
    }

}

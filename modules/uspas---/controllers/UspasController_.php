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
	
    public function actionAppraisalstatus()
    {
		$dt = USPAS::GET_APPRAISED_STAFF();
		return $this->render('collegeappraisalstatus',['data'=>$dt]);
    }
	 public function actionAppraisalstatusuni()
    {
		$dt = USPAS::GET_APPRAISED_STAFFOVERAL();
		return $this->render('collegeappraisalstatusuni',['data'=>$dt]);
    }
    public function actionIndex()
    {
        return $this->render('index');
    }

}

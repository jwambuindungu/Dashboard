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
	public function actionGrantstatust()
    {
		$dt = RGMIS::GET_RECEIVED_GRANT();
		return $this->render('collegegrantstatust',['data'=>$dt]);
    }
	
	 public function actionGrantstatusunit()
    {
		$dt = RGMIS::GET_GRANTINCOME();
		return $this->render('collegegrantstatusunit',['data'=>$dt]);
    }
	public function actionGrantstatusuni()
    {
		$dt = RGMIS::GET_GRANTINCOME();
		return $this->render('collegegrantstatusuni',['data'=>$dt]);
    }
    public function actionIndex()
    {
        
		
		$dt = RGMIS::GET_GRANTINCOME();
		foreach($dt as $k){
			$totalgrant=$k["TOTAL_BUDGET"];
			$overhead=$k["OVERHEAD_AMOUNT"];
			$pi_grant=$k["PI_NET_GRANT"];
        }
        return $this->render('index',['totalgrant'=>$totalgrant,'overhead'=>$overhead,'pi_grant'=>$pi_grant]);
    }

}

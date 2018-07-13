<?php
namespace app\modules\smis\controllers;
use Yii;
use app\modules\smis\models\SMIS;
use yii\filters\AccessControl;
use yii\web\Request;

class SmisController extends \yii\web\Controller
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

//	public static function rq()
//    {
//        return Yii::$app->request;
//    }

	
    public function actionPostgradIntake($intake='')
    {
        $dt = [];
        if(empty($intake)) {
            $intake = SMIS::ACA_YEAR();
            $intake = $intake[0]['INTAKE_NAME'];
        }
        $dt = SMIS::APP_INTAKE($intake);
        return $this->render('postgrad_intake',['data'=>$dt,'intake'=>$intake]);
    }
	
	public function actionPeriodicallfees($date_range='')
	{
	    $drange = [];
	    if(!empty($date_range)){
	        $drange = explode('~',strtoupper($date_range));
        }
		$dt=SMIS::PERIODIC_FEES($drange);
		return $this->render('periodicallfees',['data'=>$dt,'drange'=>$drange]);
	}

	public function actionStudentsOnSession()
	{
		$dt=SMIS::STUDENTS_ON_SESSION();
		return $this->render('students_session',['data'=>$dt]);
	}
	
	public function actionForeignstudents()
	{
		$ac_year=Yii::$app->request->get('ac_year','2018/2019');
		
		$dt=SMIS::FOREIGN_STUDENTS($ac_year);
		return $this->render('foreignstudents',['data'=>$dt,'ac_year'=>$ac_year]);
	}
	public function actionGraduandsbalances()
	{
		$ac_year=Yii::$app->request->get('ac_year','2016/2017');
		
		$dt=SMIS::GRADUANDS_BALANCES($ac_year);
		return $this->render('graduandsbalances',['data'=>$dt,'ac_year'=>$ac_year]);
	}
	
	public function actionGraduands()
	{
		$ac_year=Yii::$app->request->get('ac_year','2016/2017');
		$dt=SMIS::PROGRAMME_GRADUANDS($ac_year);
		return $this->render('graduands',['data'=>$dt,'ac_year'=>$ac_year]);
	}


}

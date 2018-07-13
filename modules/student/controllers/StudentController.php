<?php

namespace app\modules\student\controllers;

use app\components\DATA_INTERVAL;
use app\modules\student\models\APPLICATIONINTAKE;
use app\modules\student\models\APPLICATIONS;
use yii\filters\AccessControl;

class StudentController extends \yii\web\Controller
{
    //public $layout = '//nocharts';
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

    public function actionAdmission()
    {
        return $this->render('admission');
    }

    public function actionDashboard()
    {
        $duration = '-5';
        $interval = DATA_INTERVAL::MONTH_INTERVAL;

        $this->view->title = 'SMIS Dashboard';
        $data = APPLICATIONS::BUILD_CHART_DATA($duration, $interval);//GET_SUPERVISOR_PENDING();
        $date_obj = APPLICATIONS::$date_range_obj;


        return $this->render('index', [
            'chartdata' => $data,
            'date_obj' => $date_obj
        ]);
    }

    public function actionApplication()
    {
        $duration = '-5';
        $interval = DATA_INTERVAL::MONTH_INTERVAL;

        $this->view->title = 'Student Application Intake';
        $data = APPLICATIONS::BUILD_CHART_DATA($duration, $interval);//GET_SUPERVISOR_PENDING();
        $dataProvider = APPLICATIONS::BUILD_TABLE_DATA($duration, $interval);
        $date_obj = APPLICATIONS::$date_range_obj;


        return $this->render('application', [
            'dataProvider' => $dataProvider,
            'date_obj' => $date_obj
        ]);
    }


    public function actionIntake()
    {
        $this->layout = '//main';
        return $this->render('intakes');
    }

}

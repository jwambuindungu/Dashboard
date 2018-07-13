<?php

namespace app\modules\student\controllers;


use app\modules\student\models\APPLICATIONINTAKE;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class IntakeController extends \yii\web\Controller
{
    //public $layout = '//nocharts';


    /**
     * @inheritdoc
     */
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'detail' => ['GET'], //allow only post for this action
                    'applicants-data' => ['GET'], //allow only post for this action
                    'prog-detail' => ['GET'], //allow only post for this action
                ],
            ],
        ];
    }

    public function actionIntakeDetail($intake_name, $col_code, $start_date, $end_date)
    {
        $this->view->title = 'Student Intake Stats for ' . $intake_name;

        $data = APPLICATIONINTAKE::BUILD_PROG_CHART_DATA($intake_name, $col_code, $start_date, $end_date);
        $dataProvider = APPLICATIONINTAKE::BUILD_PROG_TABLE_DATA($intake_name, $col_code, $start_date, $end_date);


        return $this->render('index', [
            'chartdata' => $data,
            'col_code' => $col_code,
            'dataProvider' => $dataProvider,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'intake_name' => $intake_name
        ]);
    }

    public function actionCollegeDetail($intake_name, $start_date, $end_date)
    {

        /*$intake_name = \Yii::$app->request->post('intake_name');
        $deg_code = \Yii::$app->request->post('deg_code');
        $status = \Yii::$app->request->post('status');
        $start_date = \Yii::$app->request->post('start_date');
        $end_date = \Yii::$app->request->post('end_date');*/


        $this->view->title = 'Applications for ' . $intake_name;

        $data = [];//APPLICATIONINTAKE::BUILD_COL_DETAIL_CHART_DATA($intake_name, $start_date, $end_date);
        $dataProvider = APPLICATIONINTAKE::BUILD_COL_DETAIL_TABLE_DATA($intake_name, $start_date, $end_date);

        return $this->render('prog_details', [
            'chartdata' => $data,
            'dataProvider' => $dataProvider,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'intake_name' => $intake_name,
        ]);
    }

    public function actionProgDetail($intake_name,$col_code, $deg_code, $status, $start_date, $end_date)
    {

        /*$intake_name = \Yii::$app->request->post('intake_name');
        $deg_code = \Yii::$app->request->post('deg_code');
        $status = \Yii::$app->request->post('status');
        $start_date = \Yii::$app->request->post('start_date');
        $end_date = \Yii::$app->request->post('end_date');*/

        if ($status == 1) {
            $this->view->title = 'Complete Applications for ' . $deg_code . ' ' . $intake_name;
        } else {
            $this->view->title = 'Incomplete Applications for ' . $deg_code . ' ' . $intake_name;
        }

        $data = [];//APPLICATIONINTAKE::BUILD_PROG_INTAKE_CHART_DATA($intake_name, $deg_code, $status, $start_date, $end_date);
        $dataProvider = APPLICATIONINTAKE::BUILD_PROG_INTAKE_TABLE_DATA($intake_name, $deg_code, $status, $start_date, $end_date);


        return $this->render('prog_applicants', [
            'chartdata' => $data,
            'dataProvider' => $dataProvider,
            'col_code' => $col_code,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'intake_name' => $intake_name,
            'status' => $status
        ]);
    }
}

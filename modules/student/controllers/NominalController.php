<?php

namespace app\modules\student\controllers;


use app\modules\student\models\APPLICATIONINTAKE;
use app\modules\student\models\NOMINAL_ROLL_MODEL;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class NominalController extends \yii\web\Controller
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

    public function actionNominalRoll()
    {
        $this->view->title = 'Nominal Roll By Academic Year';
        $dataProvider = NOMINAL_ROLL_MODEL::NOMINAL_AC_YEAR_DATA_TABLE();
        return $this->render('academic_year_nominal', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionNominalYear($ac_year)
    {
        $dataProvider = NOMINAL_ROLL_MODEL::BUILD_NOMINAL_ARRAY_DATA($ac_year);
        $this->view->title = 'Nominal Roll for ' . $ac_year;
        return $this->render('year_nominal', [
            'dataProvider' => $dataProvider,
        ]);
    }
}

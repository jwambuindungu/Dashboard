<?php

namespace app\modules\staff\controllers;

use app\modules\staff\models\DATA;
use yii\filters\AccessControl;

class DashboardController extends \yii\web\Controller
{
    private $user_roles;
    public function behaviors()
    {
        $def = ['VC_ROLE','COLLEGE_PRINCIPAL']; // Default for All Actions
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions'=>['index',],
                        'allow' => ((count(
                            array_intersect(array_merge($def,['FINANCE_OFFICER_ROLE',]),
                                $this->user_roles)
                        ))?1:0),
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        $this->user_roles = \Yii::$app->session->get('roles');
        $this->user_roles = empty($this->user_roles)?[]:$this->user_roles;
        return parent::beforeAction($action);
    }
    
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGetStaffGenderAjax()
    {
        $dataBP 	= DATA::BUILD_CHART();
        $this->renderPartial('@app/modules/staff/views/control/staffgender_graph', [
            'colgendata'	=>json_encode($dataBP['graph'])
        ]);
    }

    public function actionFinance()
    {
        return $this->render('finance');
    }
	
    public function actionIndex1()
    {
        $staffC 	= DATA::GET_POP();
        $staffTS 	= DATA::GET_POPTS();
        $staffNTS 	= DATA::GET_POPNTS();
        $staffP 	= DATA::GET_POPPS();
        $term 		= DATA::GET_ETERMS();
        $pos 		= DATA::GET_EPOS();
        $prof 		= DATA::GET_PROFS();
        $retire 	= DATA::GET_RETIRECOUNT();

        return $this->render('index_carousel', [
            'st' 			=> $staffC,
            'ts' 			=> $staffTS,
            'nts' 			=> $staffNTS,
            'ps' 			=> $staffP,
            'retire' 		=> $retire,
			// POS Status
            'active' 		=> $pos['ACTIVE'],
            'absence' 		=> $pos['ABSENCE'],
            'contract' 		=> $pos['CONTRACT'],
            'leave' 		=> $pos['OTHER_LEAVE'],
            'second' 		=> $pos['SECONDED'],
            'suspend' 		=> $pos['SUSPENDED'],
			// Terms Status
            'permanent'		=> $term['PERMANENT'],
            'temp' 			=> $term['TEMPORARY'],
            'oncontract'	=> $term['CONTRACT'],
            'postret' 		=> $term['POST RETIREMENT'],
        ]);
		
    }
}
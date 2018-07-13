<?php

namespace app\modules\website\controllers;

use app\modules\website\models\WEBDATA;
use yii\filters\AccessControl;

class WebsiteController extends \yii\web\Controller
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
    public function actionIndex()
    {
        $data = WEBDATA::WEBMETRICS();
        $dates = WEBDATA::DATES();
        return $this->render('index',['data'=>$data,'dates'=>$dates]);
    }

}
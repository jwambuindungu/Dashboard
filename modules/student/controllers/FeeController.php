<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 29-Jun-17
 * Time: 16:16
 */

namespace app\modules\student\controllers;


use yii\web\Controller;

class FeeController extends Controller
{
    public function actionFeeCollection()
    {
        return $this->render('fee');
    }
}
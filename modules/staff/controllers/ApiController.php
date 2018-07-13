<?php

namespace app\modules\staff\controllers;

use app\modules\staff\models\HR;
use app\modules\staff\models\DATA;
use yii\web\Response;
use yii\helpers\Json;
// use  yii\web\Application;

class ApiController extends \yii\web\Controller
{
    public function actionGet($id,$params=[])
    {
		try{
			$rd = '';
			switch($id){
				case 'scount': // Total UoN Staff Count
					$rd = self::StaffCount();
				break;
				case 'sccount': // College Count
					$rd = self::GetColSCount();
				break;
				case 'sgcount': // College Gender Count
					$rd = self::GetGenderC();
				break;
				case 'tscount': // TS Count
					$rd = self::GetTSCount();
				break;
				case 'ntscount': // NTS Count
					$rd = self::GetNTSCount();
				break;
				default:
					$rd = [];
				break;
			}
			// print_r($rd); exit;
			echo Json::encode($rd);
		}catch(Exception $e){
			echo Json::encode([]);
		}
    }
	
    public function actionT()
    {
		try{
			echo DATA::GET_GENDER_STATS();
		}catch(Exception $e){
			// echo $e->getMessage();
		}
    }
    private static function StaffCount()
    {
		return HR::STAFFCOUNT();
    }
	
    private static function GetGenderC()
    {
		return HR::GENDERCOLSTAFF();
    }
	
    private static function GetColSCount()
    {
		return HR::COLSTAFF();
    }
	
    private static function GetTSCount()
    {
		return HR::TSCOUNT();
    }
	
    private static function GetNTSCount()
    {
		return HR::NTSCOUNT();
    }
	
}

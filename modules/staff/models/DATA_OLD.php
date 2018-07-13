<?php

namespace app\modules\staff\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\httpclient\Client;

use app\modules\staff\models\HR;


class DATA extends ActiveRecord
{
    public static function GET_GENDER_STATS()
    {
        $data = HR::GENDERCOLSTAFF();
		
        return $data;
    }

    public static function GET_POP_STATS()
    {
        $data = HR::COLSTAFF();
        return $data;
    }

    public static function GET_POP()
    {
        $data = HR::STAFFCOUNT();
        return $data;
    }

    public static function GET_POPTS()
    {
        $data = HR::TSCOUNT();
        return $data;
    }
	
    public static function GET_POPNTS()
    {
        $data = HR::NTSCOUNT();
        return $data;
    }
	
    public static function GET_ETERMS()
    {
        $data = HR::EMP_TERMS();
        return $data;
    }
	
    public static function GET_EPOS()
    {
        $data = HR::EMP_POS();
        return $data;
    }
	
    public static function GET_PROFS()
    {
        $data = HR::PROF_STATS();
        return $data;
    }
	
    public static function GET_RETIRECOUNT()
    {
        $data = HR::EMP_RETIRE();
        return $data;
    }
	
	/*
	 * Generate and format Graph/Chart Data
	 */
	
	public static function BUILD_GRAPH()
    {
        $data = self::GET_GENDER_STATS();

        $labels = [];
        $m = [];
        $f = [];
        foreach ($data as $key => $value) {
            $obj = (object)$value;
            $labels[] = self::ABBR_CNAME($obj->COL_NAME);
            $m[] = $obj->MALE;
            $f[] = $obj->FEMALE;
        }

        $chartData = [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'MALE',
                    'data' => $m,
                    'borderColor' => '#00B21D',
                    'fill' => false,
                    'backgroundColor' => '#00B21D'
                ],
                [
                    'label' => 'FEMALE',
                    'data' => $f,
                    'borderColor' => '#FF0000',
                    'fill' => false,
                    'backgroundColor' => '#FF0000'

                ]
            ]
        ];

        return $chartData;
    }
	
	public static function BUILD_PIE()
    {
        $data = self::GET_POP_STATS();

        $labels = [];
        $m = [];
        $f = [];
        foreach ($data as $key => $value) {
            $obj = (object)$value;
            $labels[] = self::ABBR_CNAME($obj->COL_NAME);
            $t[] = $obj->TOT;
        }

		$bgcol = self::genColor(count($labels));
		
		$pieChartData = [
			'labels' => $labels,
			'datasets' => [
				[
					'label' => "Population",
					'backgroundColor' => $bgcol,
					'data' => $t
				]
			],
		];

        return $pieChartData;
    }
	
	public static function ABBR_CNAME($cName)
    {
        $nmD = strtoupper($cName);
		$a   = array("OF", "AND");
		$b   = array("", "");
		$forAcc = str_replace($a, $b, $nmD);
		$nm = preg_replace('~\b(\w)|.~', '$1', $forAcc);
		if(strlen($nm)<3)
			$nm=$nmD;

        return $nm;
    }
	
	private static function genColor($cnt)
    {
		$clres = [];
        $cl = ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850", "#bada55", "#00ffd2", "#97a7a8"];
		$clen = count($cl);
		for($i=0;$i<$cnt;$i++){
			if($i>$clen)
				$clres[]=$cl[$cnt-$i];
			else{
				$clres[]=$cl[$i];
			}
		}
        return $clres;
    }
}
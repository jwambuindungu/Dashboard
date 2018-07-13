<?php

namespace app\modules\staff\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\helpers\ArrayHelper;

use app\components\DATA_INTERVAL;

class STAFF_STUFF extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '$schema_name.DASH_TS_NTS';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('hr_db');
    }

    /**
     * @param string $schema_name
     * @return mixed
     *
     * @deprecated
     */
    public static function GET_BUDGET($yr='2014',$schema_name = 'P15_2680_94')
    {
		$db = self::getDb();
		$model = $db->createCommand("
		SELECT * FROM $schema_name.MNG_COL_ALLOCATION
		WHERE YEAR = $yr
		ORDER BY COL_NAME
		");
		$data = $model->queryAll();
		
        return $data;
    }
	
    public static function GET_POS_STATS_COL($schema_name = 'P15_2680_94')
    {
		$db = self::getDb();
		$model = $db->createCommand("
		SELECT 
		COL_NAME COLLEGE,ACTIVE,ABSENCE,CONTRACT,OTHER_LEAVE,SECONDED,SUSPENDED 
		FROM $schema_name.MNG_POS_COL
		ORDER BY COL_NAME
		");
		$data = $model->queryAll();
		
        return $data;
    }
	
    public static function GET_COL_ABRACKET($schema_name = 'P15_2680_94')
    {
		$db = self::getDb();
		$model = $db->createCommand("
		SELECT 
		COL_CODE,COL_NAME COLLEGE,\"BELOW 35\",\"35 TO 64\",\"65 & ABOVE\",TOTAL
		FROM $schema_name.MNG_COL_BRACKET
		ORDER BY COL_NAME
		");
		$data = $model->queryAll();
		
        return $data;
    }
	
    public static function GET_COL_ABRACKETT($schema_name = 'P15_2680_94')
    {
		$db = self::getDb();
		$model = $db->createCommand("
		SELECT 
		SUM(\"BELOW 35\"),SUM(\"35 TO 64\"),SUM(\"65 & ABOVE\"),SUM(TOTAL)
		FROM $schema_name.MNG_COL_BRACKET
		");
		$data = $model->queryOne();
		
        return $data;
    }
	
    public static function GET_DEPT_ABRACKET($col,$schema_name = 'P15_2680_94')
    {
		$db = self::getDb();
		$model = $db->createCommand("
		SELECT 
		DEPT_NAME DEPARTMENT,\"BELOW 35\",\"35 TO 64\",\"65 & ABOVE\",TOTAL
		FROM $schema_name.MNG_DEPT_BRACKET
		WHERE COL_CODE = '$col'
		ORDER BY DEPT_NAME
		");
		$data = $model->queryAll();
		
        return $data;
    }
	
    public static function GET_DEPT_ABRACKETT($col,$schema_name = 'P15_2680_94')
    {
		$db = self::getDb();
		$model = $db->createCommand("
		SELECT 
		SUM(\"BELOW 35\"),SUM(\"35 TO 64\"),SUM(\"65 & ABOVE\"),SUM(TOTAL)
		FROM $schema_name.MNG_DEPT_BRACKET
		WHERE COL_CODE = '$col'
		");
		$data = $model->queryOne();
		
        return $data;
    }
	
    public static function GET_VBUDGET($col,$yr='2014',$schema_name = 'P15_2680_94')
    {
		$db = self::getDb();
		$model = $db->createCommand("
		SELECT 
		VOTE_CODE,VOTE_NAME,SUM(ALLOCATION) ALLOCATION,SUM(EXPENDITURE) EXPENDITURE 
		FROM $schema_name.MNG_VOTE_ALLOCATION
		WHERE YEAR = $yr AND COL_CODE='$col'
		GROUP BY VOTE_CODE,VOTE_NAME
		ORDER BY VOTE_CODE,VOTE_NAME
		");
		$data = $model->queryAll();
		
        return $data;
    }
	
    public static function GET_COL_STAFF($schema_name = 'P15_2680_94')
    {
		$db = self::getDb();
		$model = $db->createCommand("SELECT * FROM $schema_name.MNG_COL_TTYPE");
		$data = $model->queryAll();
		
        return $data;
    }
	
    public static function GET_DESG_SEX($col,$t,$schema_name = 'P15_2680_94')
    {
		$db = self::getDb();
		$tp = "TS";
		if($t="T"){
			$tp = "NTS";
		}
		if($t="P"){
			$tp = "P";
		}
		$sql = "
			SELECT * FROM $schema_name.MNG_DSG_GENDER
			WHERE TTYPE='$tp'
			AND COL_CODE = '$col'
			ORDER BY CATEGORY,GRADE_CODE";
		$model = $db->createCommand($sql);
		$data = $model->queryAll();
		
        return $data;
    }
	
	
    public static function GET_GRADE_STAFF($col,$grd,$t,$schema_name = 'P15_2680_94')
    {
		$tp = "TS";
		if($t="T"){
			$tp = "NTS";
		}
		if($t="P"){
			$tp = "P";
		}
		$db = self::getDb();
		$sql = "SELECT *FROM $schema_name.MNG_EMP_GRADE_DSG
			WHERE COL_CODE = '$col'
			AND GRADE_CODE = '$grd'
			AND TTYPE = '$tp'
			ORDER BY PAYROLL_NO";
		// print_r($sql);exit;
		$model = $db->createCommand($sql);
		$data = $model->queryAll();
		
        return $data;
    }
	
    public static function GETCOL($col,$schema_name = 'P15_2680_94')
    {
		$db = self::getDb();
		$model = $db->createCommand("SELECT COL_NAME FROM $schema_name.COLLEGES WHERE COL_CODE='$col'");
		$data = $model->queryScalar();
		// print_r($data);exit;
        return $data;
    }
	
    public static function GETGRADE($gc,$schema_name = 'P15_2680_94')
    {
		$db = self::getDb();
		$model = $db->createCommand("SELECT GRADE_NAME FROM $schema_name.GRADES WHERE GRADE_CODE='$gc'");
		$data = $model->queryScalar();
		// print_r($data);exit;
        return $data;
    }
	
    public static function GETPERIODS($schema_name = 'P15_2680_94')
    {
		$db = self::getDb();
		$sql = "SELECT ALL $schema_name.PERIODS.PRD_CODE, 
			$schema_name.MONTHS.MONTH_NAME||', '||$schema_name.PERIODS.PRD_YEAR PERIOD
			FROM $schema_name.PERIODS, $schema_name.MONTHS
			WHERE ($schema_name.PERIODS.MONTH_CODE=$schema_name.MONTHS.MONTH_CODE)
			AND PUBLISH = 1
			ORDER BY $schema_name.PERIODS.PRD_YEAR DESC, $schema_name.PERIODS.PRD_CODE DESC";
		$model = $db->createCommand($sql);
		$data = $model->queryAll();
        return $data;
    }
	
    public static function GETPERIOD($prdcode,$schema_name = 'P15_2680_94')
    {
		$db = self::getDb();
		
		$sql = "SELECT $schema_name.MONTHS.MONTH_NAME||', '||$schema_name.PERIODS.PRD_YEAR PERIOD
              FROM $schema_name.PERIODS, $schema_name.MONTHS
              WHERE ($schema_name.PERIODS.MONTH_CODE=$schema_name.MONTHS.MONTH_CODE) 
			  AND $schema_name.PERIODS.PRD_CODE = '$prdcode' ";
		$model = $db->createCommand($sql);
		$data = $model->queryScalar();
        return $data;
    }
	
    public static function GETDEFAULTPRD($prdcode,$schema_name = 'P15_2680_94')
    {
		$db = self::getDb();
		
		$sql = "SELECT PRD_CODE FROM $schema_name.PERIODS WHERE PRD_CODE='$prdcode' AND PUBLISH = 1";
		$model = $db->createCommand($sql);
		$data = $model->queryScalar();
        return $data;
    }
	
    public static function GETCSUM($period,$schema_name = 'P15_2680_94')
    {
		$db = self::getDb();
		$sql = "SELECT ALL $schema_name.PERIODS.PRD_CODE, 
			$schema_name.MONTHS.MONTH_NAME||', '||$schema_name.PERIODS.PRD_YEAR PERIOD
			FROM $schema_name.PERIODS, $schema_name.MONTHS
			WHERE ($schema_name.PERIODS.MONTH_CODE=$schema_name.MONTHS.MONTH_CODE)
			AND PUBLISH = 1
			ORDER BY $schema_name.PERIODS.PRD_YEAR DESC, $schema_name.PERIODS.PRD_CODE DESC";
		$model = $db->createCommand($sql);
		$data = $model->queryAll();
        return $data;
    }
	
    public static function GETSUMPRD($p,$p1,$p2,$schema_name = 'P15_2680_94')
    {
		$db = self::getDb();
		$sql = "SELECT 
		$schema_name.REPORT_TITLES.REPORT_TITLE, 
		$schema_name.TRANSACTIONS.TRAN_CODE, 
		$schema_name.TRANSACTIONS.TRAN_NAME, 
		$schema_name.REPORT_TITLES.TITLE_CODE, 
		SUM(case when $schema_name.PROCESSED_DATA.PRD_CODE='$p2' THEN $schema_name.PROCESSED_DATA.AMOUNT  ELSE 0.00 END) PREV2,
		SUM(case when $schema_name.PROCESSED_DATA.PRD_CODE='$p1' THEN $schema_name.PROCESSED_DATA.AMOUNT  ELSE 0.00 END) PREV1,
		SUM(case when $schema_name.PROCESSED_DATA.PRD_CODE='$p' THEN $schema_name.PROCESSED_DATA.AMOUNT  ELSE 0.00 END) CURR
		FROM $schema_name.PROCESSED_DATA, $schema_name.TRANSACTIONS, $schema_name.PERIODS, 
		$schema_name.REPORT_TRANS, $schema_name.REPORT_TITLES
		WHERE ($schema_name.PERIODS.PRD_CODE IN ('$p1','$p2','$p')
		AND $schema_name.REPORT_TITLES.TITLE_CODE IN ('01', '02', '03'))
		AND (($schema_name.PROCESSED_DATA.TRAN_CODE=$schema_name.TRANSACTIONS.TRAN_CODE)
		AND ($schema_name.PROCESSED_DATA.PRD_CODE=$schema_name.PERIODS.PRD_CODE)
		AND ($schema_name.REPORT_TRANS.TRAN_CODE=$schema_name.TRANSACTIONS.TRAN_CODE)
		AND ($schema_name.REPORT_TRANS.TITLE_CODE=$schema_name.REPORT_TITLES.TITLE_CODE))
		GROUP BY $schema_name.REPORT_TITLES.TITLE_CODE, $schema_name.REPORT_TITLES.REPORT_TITLE, 
		$schema_name.TRANSACTIONS.TRAN_CODE,$schema_name.TRANSACTIONS.TRAN_NAME ,REPORT_TITLES.TITLE_CODE
		ORDER BY $schema_name.REPORT_TITLES.TITLE_CODE, $schema_name.REPORT_TITLES.REPORT_TITLE, 
		$schema_name.TRANSACTIONS.TRAN_CODE";
		$model = $db->createCommand($sql);
		$data = $model->queryAll();
        return $data;
    }
	
    public static function LISTPERIODS()
    {
		$listData=ArrayHelper::map(self::GETPERIODS(),'PRD_CODE','PERIOD');
		return $listData;
    }
	
    public static function YEARLIST()
    {
		$lYr = 2000;
		$currDay = date('j'); 
		$currMon = date('n'); 
		$currYr = date('Y');
		$yList = [];
		
		if($currMon > 6){
			$currYr++;
		}
		
		for($i=$currYr;$i>=$lYr;$i--){
			$yList[$i]=$i;
		}
		return $yList;
    }

    public static function BUILD_TABLE_DATA($duration_back, $duration_name, $schema_name = 'onlineapp')
    {

        $data = self::GET_INTAKE_STATS($duration_back, $duration_name, $schema_name);

        $array_data = new ArrayDataProvider([
            'allModels' => $data,
            'sort' => [
                'attributes' => ['INTAKE_NAME', 'COMPLETE_APPLICATIONS', 'INCOMPLETE_APPLICATIONS', 'INTAKE_TOTAL'],
            ],
        ]);

        return $array_data;
    }
	
    public static function BUILD_CHART_DATA($duration_back, $duration_name, $schema_name = 'onlineapp')
    {
        $data = self::GET_INTAKE_STATS($duration_back, $duration_name, $schema_name);

        $labels = [];
        $complete = [];
        $incomplete = [];
        //$bgcolor_complete = [];
        //$bgcolor_incomplete = [];
        asort($data); //sort alphabetically
        foreach ($data as $key => $value) {
            $obj = (object)$value;
            $labels[] = $obj->INTAKE_NAME;
            //$bgcolor_incomplete[] = '#' . substr(md5(rand()), 0, 6);//'rgba(255, 99, 132, 0.2)';
            //$bgcolor_complete[] = '#' . substr(md5(rand()), 0, 6);//'rgba(255, 99, 132, 0.2)';
            $complete[] = $obj->COMPLETE_APPLICATIONS;
            $incomplete[] = $obj->INCOMPLETE_APPLICATIONS;
        }

        $chartData = [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'COMPLETE APPLICATIONS (Applied for a course and Paid)',
                    'data' => $complete,
                    'borderColor' => '#00B21D',
                    'fill' => false,
                    'backgroundColor' => '#00B21D'
                ],
                [
                    'label' => 'INCOMPLETE APPLICATIONS (Applied for a course but not Paid)',
                    'data' => $incomplete,
                    'borderColor' => '#FF0000',
                    'fill' => false,
                    'backgroundColor' => '#FF0000'

                ]
            ]
        ];

        return $chartData;
    }
	
    /**
     * @param $duration_back
     * @param $duration_name
     * @param $schema_name
     * @return Json
     */
    public static function GET_INTAKE_STATS($duration_back, $duration_name, $schema_name)
    {
        $api_url = Yii::$app->params['onlineapp_api'];
        $api_user = Yii::$app->params['api_user'];
        $api_token = Yii::$app->params['api_token'];


        self::$date_range_obj = DATA_INTERVAL::COMPUTE_DATE_RANGE($duration_back, $duration_name);
        $postData = [
            'start_date' => self::$date_range_obj->START_DATE,
            'end_date' => self::$date_range_obj->END_DATE,
            'username' => $api_user,
            'password' => $api_token,
        ];

        $client = new Client(['baseUrl' => $api_url]);
        $payload = $client->createRequest()
            ->addHeaders(['content-type' => 'application/json'])
            ->setUrl('stats')
            ->setMethod('post')
            ->setOptions([
                'timeout' => 30, // set timeout to 30 seconds for the case server is not responding
            ])
            ->setData($postData);

        $response = $payload->send();
        $data = Json::decode($response->content);

        if ($response->isOk) {

        }
        return $data;

    }
}
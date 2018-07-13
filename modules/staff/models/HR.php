<?php

namespace app\modules\staff\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\helpers\ArrayHelper;

use app\components\DATA_INTERVAL;

class HR extends ActiveRecord
{
    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('hr_db');
    }

    public static function STAFFCOUNT($schema_name = 'P15_2680_94')
    {
		$db = self::getDb();
		$model = $db->createCommand("SELECT COUNT(*) TOT FROM $schema_name.EMP_VIEW");
		$data = $model->queryScalar();
		
        return $data;
    }

    public static function TSCOUNT($schema_name = 'P15_2680_94') // Teaching Staff
    {
		$columns = [
            'SUM(TS) TS'
        ];

        $query = new Query();
        $query->select($columns)
            ->from("$schema_name.MNG_COL_TTYPE");

        $command = $query->createCommand(self::getDb());

        // die($command->rawSql);
        $data = $command->queryScalar();
		
        return $data;
    }

    public static function NTSCOUNT($schema_name = 'P15_2680_94') // Non-Teaching Staff
    {
		$columns = [
            'SUM(NTS) NTS'
        ];

        $query = new Query();
        $query->select($columns)
            ->from("$schema_name.MNG_COL_TTYPE");

        $command = $query->createCommand(self::getDb());

        // die($command->rawSql);
        $data = $command->queryScalar();
		
        return $data;
    }

    public static function PSCOUNT($schema_name = 'P15_2680_94') // Project Staff
    {
		$columns = [
            'SUM(P) P'
        ];

        $query = new Query();
        $query->select($columns)
            ->from("$schema_name.MNG_COL_TTYPE");

        $command = $query->createCommand(self::getDb());

        // die($command->rawSql);
        $data = $command->queryScalar();
		
        return $data;
    }

    public static function COLSTAFF($schema_name = 'P15_2680_94') // College Staff Count
    {
		$columns = [
            'COL_NAME',
            'MIN(NVL(TS,0)+NVL(NTS,0)) TOT',
        ];

        $query = new Query();
        $query->select($columns)
            ->from("$schema_name.MNG_COL_TTYPE")
            ->groupBy(['COL_NAME'])
            ->orderBy(['COL_NAME' => SORT_ASC]);
        //->limit(5);

        $command = $query->createCommand(self::getDb());

        // die($command->rawSql);
        $data = $command->queryAll();
        return $data;
    }

    public static function COLSTAFFAGE($schema_name = 'P15_2680_94') // College Staff Age Brackets
    {
		$columns = [
            'COL_NAME',
            '"BELOW 35" A',
			'"35 TO 64" B',
			'"65 & ABOVE" C'
        ];

        $query = new Query();
        $query->select($columns)
            ->from("$schema_name.MNG_COL_BRACKET")
            ->orderBy(['COL_NAME' => SORT_ASC]);
        //->limit(5);

        $command = $query->createCommand(self::getDb());

        // die($command->rawSql);
        $data = $command->queryAll();
        return $data;
    }

    public static function COLSTAFFCAT($schema_name = 'P15_2680_94') // College Staff Age Brackets
    {
		$columns = [
            'COL_NAME',
            'NVL(TS,0) TS',
			'NVL(NTS,0) NTS',
			'NVL(P,0) P'
        ];

        $query = new Query();
        $query->select($columns)
            ->from("$schema_name.MNG_COL_TTYPE")
            ->orderBy(['COL_NAME' => SORT_ASC]);
        //->limit(5);

        $command = $query->createCommand(self::getDb());

        // die($command->rawSql);
        $data = $command->queryAll();
        return $data;
    }

    public static function EMP_POS($schema_name = 'P15_2680_94') // Employee Position Status
    {
		$columns = [
            'ABSENCE',
//			'CONTRACT',
			'SABBATICAL',
			'STUDY',
			'OTHER_LEAVE',
			'SECONDED',
			'SUSPENDED',
			'ACTIVE'
        ];

        $query = new Query();
        $query->select($columns)
            ->from("$schema_name.MNG_POS_STAT");
        //->limit(5);

        $command = $query->createCommand(self::getDb());

        // die($command->rawSql);
        $data = $command->queryOne();
        return $data;
    }

    public static function EMP_TERMS($schema_name = 'P15_2680_94') // Employee Terms Stats
    {
		$columns = [
            'PERMANENT',
			'TEMPORARY',
			'CONTRACT',
			'"POST RETIREMENT"'
        ];

        $query = new Query();
        $query->select($columns)
            ->from("$schema_name.MNG_TERMS_STATS");
        //->limit(5);

        $command = $query->createCommand(self::getDb());

        // die($command->rawSql);
        $data = $command->queryOne();
        return $data;
    }

    public static function PROF_STATS($schema_name = 'P15_2680_94') // Professors in the University
    {
		$columns = [
            'MALE',
			'FEMALE',
        ];

        $query = new Query();
        $query->select($columns)
            ->from("$schema_name.MNG_PROF_STATS");
        //->limit(5);

        $command = $query->createCommand(self::getDb());

        // die($command->rawSql);
        $data = $command->queryOne();
        return $data;
    }

    public static function EMP_RETIRE($schema_name = 'P15_2680_94') // Staff about to retire
    {
		$columns = [
            'COUNT(*)',
        ];

        $query = new Query();
        $query->select($columns)
            ->from("$schema_name.MNG_RETIRE_STATS")
            ->where(['>','DIFF', -1]);
        //->limit(5);

        $command = $query->createCommand(self::getDb());

        // die($command->rawSql);
        $data = $command->queryScalar();
        return $data;
    }

    public static function COL_GENDER($schema_name = 'P15_2680_94') // Staff about to retire
    {
		$columns = [
            'COL_CODE',
            'COL_NAME',
            'SUM(MALE) MALE',
            'SUM(FEMALE) FEMALE',
        ];

        $query = new Query();
        $query->select($columns)
            ->from("$schema_name.MNG_DSG_GENDER")
            ->groupBy(['COL_CODE','COL_NAME'])
            ->orderBy(['COL_NAME' => SORT_ASC]);
        //->limit(5);

        $command = $query->createCommand(self::getDb());

        // die($command->rawSql);
        $data = $command->queryAll();
        return $data;
    }

    public static function CTRL_SUMM($schema_name = 'P15_2680_94') // Control Summary
    {
		$lastDay = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')); 
		$currDay = date('d'); 
		$diff = $lastDay-$currDay;
		$p=date('m/y',strtotime('-1 month', time()));
		$p1=date('m/y',strtotime('-2 month', time()));
		$p2=date('m/y',strtotime('-3 month', time()));
		
		if($diff < 2){
			$p2=$p1;
			$p1=$p;
			$p=date('m/y');
		}
		$mnt = explode('/',$p);
		$db = self::getDb();
		$sql = "SELECT
		$schema_name.TRANSACTIONS.TRAN_NAME,
		SUM(case when $schema_name.PROCESSED_DATA.PRD_CODE='$p2' THEN $schema_name.PROCESSED_DATA.AMOUNT  ELSE 0.00 END) PREV2,
		SUM(case when $schema_name.PROCESSED_DATA.PRD_CODE='$p1' THEN $schema_name.PROCESSED_DATA.AMOUNT  ELSE 0.00 END) PREV1,
		SUM(case when $schema_name.PROCESSED_DATA.PRD_CODE='$p' THEN $schema_name.PROCESSED_DATA.AMOUNT  ELSE 0.00 END) CURR
		FROM $schema_name.PROCESSED_DATA, $schema_name.TRANSACTIONS, $schema_name.PERIODS, 
		$schema_name.REPORT_TRANS, $schema_name.REPORT_TITLES
		WHERE ($schema_name.PERIODS.PRD_CODE IN ('$p1','$p2','$p')
		AND PROCESSED_DATA.TRAN_CODE IN ('800','890','900')
		AND $schema_name.REPORT_TITLES.TITLE_CODE IN ('01', '02', '03'))
		AND (($schema_name.PROCESSED_DATA.TRAN_CODE=$schema_name.TRANSACTIONS.TRAN_CODE)
		AND ($schema_name.PROCESSED_DATA.PRD_CODE=$schema_name.PERIODS.PRD_CODE)
		AND ($schema_name.REPORT_TRANS.TRAN_CODE=$schema_name.TRANSACTIONS.TRAN_CODE)
		AND ($schema_name.REPORT_TRANS.TITLE_CODE=$schema_name.REPORT_TITLES.TITLE_CODE))
		GROUP BY $schema_name.TRANSACTIONS.TRAN_NAME";
		$model = $db->createCommand($sql);
		$data = ['data'=>$model->queryAll(),'prdm'=>$mnt[0],'prdy'=>$mnt[1]];
        return $data;
    }

    public static function CTRL_VSUMM($prd, $schema_name = 'P15_2680_94') // Control Summary
    {
		$pH = explode('/',$prd);
		$p = $prd;
		$subYr = substr($prd, 5, 1);
		$p1=date("m/y", mktime(0,0,0,(int)$pH[0]-1,1,(int)$pH[1])).''.$subYr;
		$p2=date("m/y", mktime(0,0,0,(int)$pH[0]-2,1,(int)$pH[1])).''.$subYr;
		// print_r($p1);exit;
		$db = self::getDb();
		$sql = "SELECT
		$schema_name.TRANSACTIONS.TRAN_NAME,
		SUM(case when $schema_name.PROCESSED_DATA.PRD_CODE='$p2' THEN $schema_name.PROCESSED_DATA.AMOUNT  ELSE 0.00 END) PREV2,
		SUM(case when $schema_name.PROCESSED_DATA.PRD_CODE='$p1' THEN $schema_name.PROCESSED_DATA.AMOUNT  ELSE 0.00 END) PREV1,
		SUM(case when $schema_name.PROCESSED_DATA.PRD_CODE='$p' THEN $schema_name.PROCESSED_DATA.AMOUNT  ELSE 0.00 END) CURR
		FROM $schema_name.PROCESSED_DATA, $schema_name.TRANSACTIONS, $schema_name.PERIODS, 
		$schema_name.REPORT_TRANS, $schema_name.REPORT_TITLES
		WHERE ($schema_name.PERIODS.PRD_CODE IN ('$p1','$p2','$p')
		AND PROCESSED_DATA.TRAN_CODE IN ('800','890','900')
		AND $schema_name.REPORT_TITLES.TITLE_CODE IN ('01', '02', '03'))
		AND (($schema_name.PROCESSED_DATA.TRAN_CODE=$schema_name.TRANSACTIONS.TRAN_CODE)
		AND ($schema_name.PROCESSED_DATA.PRD_CODE=$schema_name.PERIODS.PRD_CODE)
		AND ($schema_name.REPORT_TRANS.TRAN_CODE=$schema_name.TRANSACTIONS.TRAN_CODE)
		AND ($schema_name.REPORT_TRANS.TITLE_CODE=$schema_name.REPORT_TITLES.TITLE_CODE))
		GROUP BY $schema_name.TRANSACTIONS.TRAN_NAME";
		
		$model = $db->createCommand($sql);
		$data = $model->queryAll();
        return $data;
    }
}
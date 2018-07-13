<?php

namespace app\modules\uspas\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;

class USPAS extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    // public static function tableName()
    // {
        // return 'P15_2680_94.DASH_TS_NTS';
    // }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('uspas_db');
    }

    /**
     * @param string $schema_name
     * @return mixed
     *
     * @deprecated
     */
	 public static function GET_APPRAISED_STAFF($yr='',$schema_name = 'USPAS')
    {
        if(empty($yr)){
            $y = USPAS::APPRAISAL_YEARLIST();
            $yr = $y[0]['yr'];
        }
		// Check evaluation upto to supervisor evaluation without considering supervisor comments
		$db = self::getDb();
		$sql="SELECT T1.COL_CODE,T1.COL_NAME,TOTAL,APPRAISED FROM (
                                SELECT
                                $schema_name.SPA_STAFF_VIEW.COL_CODE,
                                $schema_name.SPA_STAFF_VIEW.COL_NAME,
                                COUNT(*) AS TOTAL
                                FROM $schema_name.STAFF_APPRAISAL, $schema_name.SPA_STAFF_VIEW
                                WHERE  
								($schema_name.SPA_STAFF_VIEW.PAYROLL_NO=$schema_name.STAFF_APPRAISAL.PAYROL_NO)
																AND  ($schema_name.STAFF_APPRAISAL.PERIOD_ID='$yr')
																GROUP BY $schema_name.SPA_STAFF_VIEW.COL_CODE,
								$schema_name.SPA_STAFF_VIEW.COL_NAME
														) T1
														JOIN
														(
								SELECT COL_CODE, COUNT(*) AS APPRAISED FROM $schema_name.SPA_STAFF_VIEW WHERE $schema_name.SPA_STAFF_VIEW.PAYROLL_NO IN
								(SELECT NVL(SUBSTR(t.APPRAISEE_NO, 0, INSTR(t.APPRAISEE_NO, '_')-1), t.APPRAISEE_NO) AS PAYROLL_NO
							FROM $schema_name.APPRAISAL_STATUS t WHERE t.APPRAISEE_NO LIKE '%$yr%' AND t.APPRAISAL_CAT ='003') GROUP BY COL_CODE 
                        ) T2

                        ON T1.COL_CODE = T2.COL_CODE
                        ORDER BY COL_CODE";
			$model = $db->createCommand($sql);
		$data = $model->queryAll();
		
        return $data;
    }
	public static function GET_APPRAISED_STAFF_IN_COL($yr='',$schema_name = 'USPAS')
    {
        $col_code = Yii::$app->session->get('user_details')['COL_CODE'];
        if(empty($yr)){
            $y = USPAS::APPRAISAL_YEARLIST();
            $yr = $y[0]['yr'];
        }
		// Check evaluation upto to supervisor evaluation without considering supervisor comments
		$db = self::getDb();
	
						
						
				$sql="SELECT T1.COL_CODE,T1.DEPT_CODE,T1.DEPT_NAME, NVL(TOTAL,0) AS DEPT_TOTAL, NVL(SUPERVISOR_EVALUATED,0) AS SUPERVISED_TOTAL FROM (
                                SELECT
                                 USPAS.SPA_STAFF_VIEW.COL_CODE,
                                USPAS.SPA_STAFF_VIEW.DEPT_CODE,
                                USPAS.SPA_STAFF_VIEW.DEPT_NAME,
                                COUNT(*) AS TOTAL
                                FROM USPAS.STAFF_APPRAISAL, USPAS.SPA_STAFF_VIEW
                                WHERE  
                                (USPAS.SPA_STAFF_VIEW.PAYROLL_NO=USPAS.STAFF_APPRAISAL.PAYROL_NO)
                                AND  (USPAS.STAFF_APPRAISAL.PERIOD_ID='$yr') AND (USPAS.SPA_STAFF_VIEW.COL_CODE ='$col_code')
                                GROUP BY USPAS.SPA_STAFF_VIEW.DEPT_CODE,
                                USPAS.SPA_STAFF_VIEW.DEPT_NAME,USPAS.SPA_STAFF_VIEW.COL_CODE
                        ) T1
                        LEFT JOIN
                        (
                      SELECT DEPT_NAME,DEPT_CODE, COUNT(*) AS SUPERVISOR_EVALUATED FROM USPAS.SPA_STAFF_VIEW WHERE USPAS.SPA_STAFF_VIEW.PAYROLL_NO IN
								(SELECT NVL(SUBSTR(t.APPRAISEE_NO, 0, INSTR(t.APPRAISEE_NO, '_')-1), t.APPRAISEE_NO) AS PAYROLL_NO
							FROM USPAS.APPRAISAL_STATUS t WHERE t.APPRAISEE_NO LIKE '%$yr%' AND t.APPRAISAL_CAT ='003') 
																GROUP BY DEPT_NAME, DEPT_CODE
                        ) T2

                        ON T1.DEPT_CODE = T2.DEPT_CODE 
                        ORDER BY DEPT_CODE";		
						
						
			$model = $db->createCommand($sql);
		$data = $model->queryAll();
		
        return $data;
    }
	
	public static function GET_APPRAISED_COL($yr='',$schema_name = 'USPAS')
    {
		 $col_code = Yii::$app->session->get('user_details')['COL_CODE'];
        if(empty($yr)){
            $y = USPAS::APPRAISAL_YEARLIST();
            $yr = $y[0]['yr'];
        }
		// Check evaluation upto to supervisor evaluation without considering supervisor comments
		$db = self::getDb();
	
									
				

							$sql="SELECT T1.COL_CODE,T1.COL_NAME,TOTAL,SUPERVISOR_EVALUATED FROM (
                                SELECT
                                USPAS.SPA_STAFF_VIEW.COL_CODE,
                                USPAS.SPA_STAFF_VIEW.COL_NAME,
                                COUNT(*) AS TOTAL
                                FROM USPAS.STAFF_APPRAISAL, USPAS.SPA_STAFF_VIEW
                                WHERE  
								(USPAS.SPA_STAFF_VIEW.PAYROLL_NO=USPAS.STAFF_APPRAISAL.PAYROL_NO)
																AND  (USPAS.STAFF_APPRAISAL.PERIOD_ID='$yr') AND(USPAS.SPA_STAFF_VIEW.COL_CODE ='$col_code')
																GROUP BY USPAS.SPA_STAFF_VIEW.COL_CODE,
								USPAS.SPA_STAFF_VIEW.COL_NAME
														) T1
														JOIN
														(
								SELECT COL_CODE, COUNT(*) AS SUPERVISOR_EVALUATED FROM USPAS.SPA_STAFF_VIEW WHERE USPAS.SPA_STAFF_VIEW.PAYROLL_NO IN
								(SELECT NVL(SUBSTR(t.APPRAISEE_NO, 0, INSTR(t.APPRAISEE_NO, '_')-1), t.APPRAISEE_NO) AS PAYROLL_NO
							FROM USPAS.APPRAISAL_STATUS t WHERE t.APPRAISEE_NO LIKE '%$yr%' AND t.APPRAISAL_CAT ='003') GROUP BY COL_CODE 
                        ) T2

                        ON T1.COL_CODE = T2.COL_CODE
                        ORDER BY COL_CODE";
						
						
			$model = $db->createCommand($sql);
		$data = $model->queryAll();
		
        return $data;
    }
	
	public static function GET_APPRAISED_DEPT($yr='',$schema_name = 'USPAS')
    {
		
		 $dept_code = Yii::$app->session->get('user_details')['DEPT_CODE'];
        if(empty($yr)){
            $y = USPAS::APPRAISAL_YEARLIST();
            $yr = $y[0]['yr'];
        }
		// Check evaluation upto to supervisor evaluation without considering supervisor comments
		$db = self::getDb();
	
									
				

							$sql="SELECT T1.COL_CODE,T1.DEPT_CODE,T1.DEPT_NAME, NVL(TOTAL,0) AS DEPT_TOTAL, NVL(SUPERVISOR_EVALUATED,0) AS SUPERVISED_TOTAL FROM (
                                SELECT
                                 USPAS.SPA_STAFF_VIEW.COL_CODE,
                                USPAS.SPA_STAFF_VIEW.DEPT_CODE,
                                USPAS.SPA_STAFF_VIEW.DEPT_NAME,
                                COUNT(*) AS TOTAL
                                FROM USPAS.STAFF_APPRAISAL, USPAS.SPA_STAFF_VIEW
                                WHERE  
                                (USPAS.SPA_STAFF_VIEW.PAYROLL_NO=USPAS.STAFF_APPRAISAL.PAYROL_NO)
                                AND  (USPAS.STAFF_APPRAISAL.PERIOD_ID='$yr') AND (USPAS.SPA_STAFF_VIEW.DEPT_CODE ='$dept_code')
                                GROUP BY USPAS.SPA_STAFF_VIEW.DEPT_CODE,
                                USPAS.SPA_STAFF_VIEW.DEPT_NAME,USPAS.SPA_STAFF_VIEW.COL_CODE
                        ) T1
                        LEFT JOIN
                        (
                      SELECT DEPT_NAME,DEPT_CODE, COUNT(*) AS SUPERVISOR_EVALUATED FROM USPAS.SPA_STAFF_VIEW WHERE USPAS.SPA_STAFF_VIEW.PAYROLL_NO IN
								(SELECT NVL(SUBSTR(t.APPRAISEE_NO, 0, INSTR(t.APPRAISEE_NO, '_')-1), t.APPRAISEE_NO) AS PAYROLL_NO
							FROM USPAS.APPRAISAL_STATUS t WHERE t.APPRAISEE_NO LIKE '%$yr%' AND t.APPRAISAL_CAT ='003') 
																GROUP BY DEPT_NAME, DEPT_CODE
                        ) T2

                        ON T1.DEPT_CODE = T2.DEPT_CODE 
                        ORDER BY DEPT_CODE";
						
						
			$model = $db->createCommand($sql);
		$data = $model->queryAll();
		
        return $data;
    }
	
	
	
	/*
    public static function GET_APPRAISED_STAFF($yr='2015/2016',$schema_name = 'USPAS')
    {
		// Check evaluation upto to supervisor evaluation  considering supervisor comments
		$db = self::getDb();
		$sql = "SELECT T1.COL_CODE,T1.COL_NAME,TOTAL,APPRAISED FROM (
				SELECT 
				$schema_name.SPA_STAFF_VIEW.COL_CODE,
				$schema_name.SPA_STAFF_VIEW.COL_NAME,
				COUNT(*) AS TOTAL
				FROM $schema_name.STAFF_APPRAISAL, $schema_name.SPA_STAFF_VIEW
				WHERE   ($schema_name.SPA_STAFF_VIEW.PAYROLL_NO=$schema_name.STAFF_APPRAISAL.PAYROL_NO)
				AND  ($schema_name.STAFF_APPRAISAL.PERIOD_ID='$yr')
				GROUP BY $schema_name.SPA_STAFF_VIEW.COL_CODE, $schema_name.SPA_STAFF_VIEW.COL_NAME
			) T1
			JOIN 
			(
				SELECT COL_CODE ,COL_NAME, COUNT(*) APPRAISED FROM $schema_name.SPA_STAFF_VIEW WHERE $schema_name.SPA_STAFF_VIEW.PAYROLL_NO
				IN
				(SELECT DISTINCT NVL(SUBSTR(t.APPRAISEE_NO, 0, INSTR(t.APPRAISEE_NO, '_')-1), t.APPRAISEE_NO) AS PAYROLL 
				FROM $schema_name.STAFF_APPRAISER t,$schema_name.EVALUATORS_COMMENTS c 
				WHERE (NVL(SUBSTR(t.APPRAISEE_NO, 0, INSTR(t.APPRAISEE_NO, '_')-1), t.APPRAISEE_NO))   
				IN (  SELECT NVL(SUBSTR(t.APPRAISEE_NO, 0, INSTR(t.APPRAISEE_NO, '_')-1), t.APPRAISEE_NO) AS PAYROLL 
				FROM  $schema_name.EVALUATORS_COMMENTS t where t.RECORD_STATUS='CLOSED' AND t.COMMENT_ID like '%$yr%')
				AND t.APP_CATEGORY ='003' and t.APPRAISER_ID=c.APPRAISER_ID and t.APPRAISEE_NO  like '%$yr%')
				GROUP BY COL_NAME,COL_CODE
			) T2

			ON T1.COL_CODE = T2.COL_CODE
			ORDER BY COL_CODE";
		$model = $db->createCommand($sql);
		$data = $model->queryAll();
		
        return $data;
    }*/
	/*
	public static function GET_APPRAISED_STAFFOVERAL($yr='2015/2016',$schema_name = 'USPAS')
    {
		$db = self::getDb();
		$sql = "SELECT TOTAL,APPRAISED FROM (
                                SELECT
                               
                                COUNT(*) AS TOTAL
                                FROM $schema_name.STAFF_APPRAISAL, $schema_name.SPA_STAFF_VIEW
                                WHERE  
($schema_name.SPA_STAFF_VIEW.PAYROLL_NO=$schema_name.STAFF_APPRAISAL.PAYROL_NO)
                                AND  ($schema_name.STAFF_APPRAISAL.PERIOD_ID='$yr')
                                
                        ) T1
                        NATURAL JOIN
                        (
                               SELECT COUNT(*) APPRAISED FROM
$schema_name.SPA_STAFF_VIEW WHERE
$schema_name.SPA_STAFF_VIEW.PAYROLL_NO
                                IN
                                (SELECT DISTINCT NVL(SUBSTR(t.APPRAISEE_NO, 0, INSTR(t.APPRAISEE_NO,
'_')-1), t.APPRAISEE_NO) AS PAYROLL
                                FROM $schema_name.STAFF_APPRAISER t,$schema_name.EVALUATORS_COMMENTS c
                                WHERE (NVL(SUBSTR(t.APPRAISEE_NO, 0, INSTR(t.APPRAISEE_NO, '_')-1),
t.APPRAISEE_NO))
                                IN (  SELECT NVL(SUBSTR(t.APPRAISEE_NO, 0, INSTR(t.APPRAISEE_NO,
'_')-1), t.APPRAISEE_NO) AS PAYROLL
                                FROM  $schema_name.EVALUATORS_COMMENTS t where
t.RECORD_STATUS='CLOSED' )
                                AND t.APP_CATEGORY ='003' and t.APPRAISER_ID=c.APPRAISER_ID and
t.APPRAISEE_NO  like '%$yr%')
                        ) T2

                       ";
		$model = $db->createCommand($sql);
		$data = $model->queryAll();
		
        return $data;
    }*/
	public static function GET_APPRAISED_STAFFOVERAL($yr='',$schema_name = 'USPAS')
    {
		  if(empty($yr)){
            $y = USPAS::APPRAISAL_YEARLIST();
            $yr = $y[0]['yr'];
        }
		$db = self::getDb();
		$sql = "SELECT TOTAL,APPRAISED FROM (
                                                                                                        SELECT

                                                                                                        COUNT(*) AS TOTAL
                                                                                                        FROM USPAS.STAFF_APPRAISAL,
                                        USPAS.SPA_STAFF_VIEW
                                                                                                        WHERE
                                        (USPAS.SPA_STAFF_VIEW.PAYROLL_NO=USPAS.STAFF_APPRAISAL.PAYROL_NO)
                                                                                                        AND
                                        (USPAS.STAFF_APPRAISAL.PERIOD_ID='$yr')

                                                                                        ) T1
                                                                                        NATURAL JOIN
                                                                                        (
                                                                                                  SELECT COUNT(*) AS APPRAISED FROM
USPAS.SPA_STAFF_VIEW WHERE USPAS.SPA_STAFF_VIEW.PAYROLL_NO
IN
                                                                (SELECT NVL(SUBSTR(t.APPRAISEE_NO, 0, INSTR(t.APPRAISEE_NO,
'_')-1), t.APPRAISEE_NO) AS PAYROLL_NO
                                                        FROM USPAS.APPRAISAL_STATUS t WHERE t.APPRAISEE_NO LIKE
'%$yr%' AND t.APPRAISAL_CAT ='003')
                                                                                        ) T2
       ";
		$model = $db->createCommand($sql);
		$data = $model->queryAll();
		
        return $data;
    }

	public static function GET_STAFF_NOT_APPRAISED_OVERRALL($yr='',$schema_name = 'USPAS')
    {/* 
		  if(empty($yr)){
            $y = USPAS::APPRAISAL_YEARLIST();
            $yr = $y[0]['yr'];
        } */
		$db = self::getDb();
			/* $sql = "select P15_2680_94.SPA_STAFF_VIEW.PAYROLL_NO FROM P15_2680_94.SPA_STAFF_VIEW  LEFT JOIN 
					(
					SELECT * FROM (SELECT OVERAL_SCORE,PERIOD_ID,PAYROL_NO , STAFF_APP_ID ,

					cast(regexp_replace(SUBSTR(PERIOD_ID,-4,4), '[^0-9]+', '') as number)  AS YEAR,

					ROW_NUMBER () OVER (
											PARTITION BY PAYROL_NO
											ORDER BY PAYROL_NO,
												PERIOD_ID DESC
										) AS NO_OF_YEARS_APPRAISED

					 from USPAS.STAFF_APPRAISAL ) A

					WHERE   A.OVERAL_SCORE > 0
					) B 

					 ON P15_2680_94.SPA_STAFF_VIEW.PAYROLL_NO  = B.PAYROL_NO 

					WHERE B.PAYROL_NO  IS NULL
						"; */
						
				$sql="select P15_2680_94.SPA_STAFF_VIEW.PAYROLL_NO FROM P15_2680_94.SPA_STAFF_VIEW  LEFT JOIN 
						(
						SELECT * FROM (SELECT OVERAL_SCORE,PERIOD_ID,PAYROL_NO , STAFF_APP_ID ,

						cast(regexp_replace(SUBSTR(PERIOD_ID,-4,4), '[^0-9]+', '') as number)  AS YEAR,

						ROW_NUMBER () OVER (
												PARTITION BY PAYROL_NO
												ORDER BY PAYROL_NO,
													PERIOD_ID DESC
											) AS NO_OF_YEARS_APPRAISED

						 from USPAS.STAFF_APPRAISAL ) A

						WHERE  YEAR > 2015 AND A.OVERAL_SCORE > 0
						) B 

						 ON P15_2680_94.SPA_STAFF_VIEW.PAYROLL_NO  = B.PAYROL_NO 

						WHERE B.PAYROL_NO  IS NULL
							";		
		$model = $db->createCommand($sql);
		$not_appdata = $model->queryAll();
		
        return $not_appdata;
    }

    public static function APPRAISAL_YEARLIST()
    {
        $lYr = 2007;
        $currDay = date('j');
        $currMon = date('n');
        $currYr = date('Y')-2;
        $yList = [];

        if($currMon > 6){
            $currYr++;
        }
        $tz=0;
        for($i=$currYr;$i>=$lYr;$i--){
            $yList[]=['yr'=>($i-1)."/".$i];
        }
        return $yList;
    }
}
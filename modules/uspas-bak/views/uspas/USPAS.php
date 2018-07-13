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
	 public static function GET_APPRAISED_STAFF($yr='2015/2016',$schema_name = 'USPAS')
    {
		$db = self::getDb();
		$sql="SELECT T1.COL_CODE,T1.COL_NAME,TOTALs,APPRAISED FROM (
                                SELECT
                                USPAS.SPA_STAFF_VIEW.COL_CODE,
                                USPAS.SPA_STAFF_VIEW.COL_NAME,
                                COUNT(*) AS TOTAL
                                FROM USPAS.STAFF_APPRAISAL, USPAS.SPA_STAFF_VIEW
                                WHERE  
								(USPAS.SPA_STAFF_VIEW.PAYROLL_NO=USPAS.STAFF_APPRAISAL.PAYROL_NO)
																AND  (USPAS.STAFF_APPRAISAL.PERIOD_ID='2015/2016')
																GROUP BY USPAS.SPA_STAFF_VIEW.COL_CODE,
								USPAS.SPA_STAFF_VIEW.COL_NAME
														) T1
														JOIN
														(
								SELECT COL_CODE, COUNT(*) AS APPRAISED FROM USPAS.SPA_STAFF_VIEW WHERE USPAS.SPA_STAFF_VIEW.PAYROLL_NO IN
								(SELECT NVL(SUBSTR(t.APPRAISEE_NO, 0, INSTR(t.APPRAISEE_NO, '_')-1), t.APPRAISEE_NO) AS PAYROLL_NO
							FROM USPAS.APPRAISAL_STATUS t WHERE t.APPRAISEE_NO LIKE '%2015/2016%' AND t.APPRAISAL_CAT ='003') GROUP BY COL_CODE 
                        ) T2

                        ON T1.COL_CODE = T2.COL_CODE
                        ORDER BY COL_CODE";
			$model = $db->createCommand($sql);
		$data = $model->queryAll();
		
        return $data;
    }
	/*
    public static function GET_APPRAISED_STAFF($yr='2015/2016',$schema_name = 'USPAS')
    {
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
t.RECORD_STATUS='CLOSED' AND t.COMMENT_ID like '%$yr%')
                                AND t.APP_CATEGORY ='003' and t.APPRAISER_ID=c.APPRAISER_ID and
t.APPRAISEE_NO  like '%$yr%')
                        ) T2

                       ";
		$model = $db->createCommand($sql);
		$data = $model->queryAll();
		
        return $data;
    }
}
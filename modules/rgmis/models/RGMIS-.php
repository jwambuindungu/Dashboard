<?php

namespace app\modules\rgmis\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;

class RGMIS extends ActiveRecord
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
        return Yii::$app->get('rgmis_db');
    }

    /**
     * @param string $schema_name
     * @return mixed
     *
     * @deprecated
     */
	 
    public static function GET_RECEIVED_GRANT()
    {
		$db = self::getDb();
		$sql = "SELECT
        
        P15_2680_94.COLLEGE_VIEW.COL_NAME AS COLLEGE_NAME,
        P15_2680_94.COLLEGE_VIEW.COL_CODE AS COLLEGE_CODE,
         SUM(BUDGET_AMOUNT) AS TOTAL_BUDGET,
         SUM((
                AGREED_PERCENTAGE * BUDGET_AMOUNT
        ) / (100 + AGREED_PERCENTAGE)) AS OVERHEAD_AMOUNT
      
       
FROM
        (
                SELECT
                        RGMIS.PROJECT_TIMELINE.START_DATE,
                        RGMIS.PROJECT_TIMELINE.END_DATE,
                        RGMIS.PROJECT_TIMELINE.PROPOSAL_ID AS PROPOSAL_PROPOSAL_ID,
                        RGMIS.PROJECT_TIMELINE.PROJECT_STATUS,
                        RGMIS.PROJECT_TIMELINE.APPROVAL_DATE,
                        EXTRACT (YEAR FROM RGMIS.PROJECT_TIMELINE.APPROVAL_DATE) AS YEAR,
                        ROW_NUMBER () OVER (
                                PARTITION BY RGMIS.PROJECT_TIMELINE.PROPOSAL_ID
                                ORDER BY
                                        RGMIS.PROJECT_TIMELINE.START_DATE DESC
                        ) AS COUNT_TIMELINES
                FROM
                        RGMIS.PROJECT_TIMELINE
        ) A
INNER JOIN RGMIS.PROPOSAL ON RGMIS.PROPOSAL.PROPOSAL_ID = A .PROPOSAL_PROPOSAL_ID
INNER JOIN RGMIS.DONOR_CURRENCY ON RGMIS.DONOR_CURRENCY.CURRENCY_ID =
RGMIS.PROPOSAL.DONOR_CURRENCY_ID
INNER JOIN P15_2680_94.COLLEGE_VIEW ON P15_2680_94.COLLEGE_VIEW.COL_CODE =
RGMIS.PROPOSAL.COLLEGE_ID
WHERE
        (
                A .COUNT_TIMELINES = 1
                AND A .PROJECT_STATUS = 'ONGOING'
                AND END_DATE > SYSDATE AND YEAR=2016
        ) group by  P15_2680_94.COLLEGE_VIEW.COL_CODE, P15_2680_94.COLLEGE_VIEW.COL_NAME";
		$model = $db->createCommand($sql);
		$data = $model->queryAll();
		
        return $data;
    }
	
	public static function GET_GRANTINCOME()
    {
		$db = self::getDb();
		$sql = "SELECT
        
       
         SUM(BUDGET_AMOUNT) AS TOTAL_BUDGET,
         SUM((
                AGREED_PERCENTAGE * BUDGET_AMOUNT
        ) / (100 + AGREED_PERCENTAGE)) AS OVERHEAD_AMOUNT,
        (SUM(BUDGET_AMOUNT)-SUM((
                AGREED_PERCENTAGE * BUDGET_AMOUNT
        ) / (100 + AGREED_PERCENTAGE))) AS PI_NET_GRANT
        
      
       
FROM
        (
                SELECT
                        RGMIS.PROJECT_TIMELINE.START_DATE,
                        RGMIS.PROJECT_TIMELINE.END_DATE,
                        RGMIS.PROJECT_TIMELINE.PROPOSAL_ID AS PROPOSAL_PROPOSAL_ID,
                        RGMIS.PROJECT_TIMELINE.PROJECT_STATUS,
                        RGMIS.PROJECT_TIMELINE.APPROVAL_DATE,
                        EXTRACT (YEAR FROM RGMIS.PROJECT_TIMELINE.APPROVAL_DATE) AS YEAR,
                        ROW_NUMBER () OVER (
                                PARTITION BY RGMIS.PROJECT_TIMELINE.PROPOSAL_ID
                                ORDER BY
                                        RGMIS.PROJECT_TIMELINE.START_DATE DESC
                        ) AS COUNT_TIMELINES
                FROM
                        RGMIS.PROJECT_TIMELINE
        ) A
INNER JOIN RGMIS.PROPOSAL ON RGMIS.PROPOSAL.PROPOSAL_ID = A .PROPOSAL_PROPOSAL_ID
INNER JOIN RGMIS.DONOR_CURRENCY ON RGMIS.DONOR_CURRENCY.CURRENCY_ID =
RGMIS.PROPOSAL.DONOR_CURRENCY_ID
INNER JOIN P15_2680_94.COLLEGE_VIEW ON P15_2680_94.COLLEGE_VIEW.COL_CODE =
RGMIS.PROPOSAL.COLLEGE_ID
WHERE
        (
                A .COUNT_TIMELINES = 1
                AND A .PROJECT_STATUS = 'ONGOING'
                AND END_DATE > SYSDATE AND YEAR=2016
        ) ";
		$model = $db->createCommand($sql);
		$data = $model->queryAll();
		
        return $data;
    }
}
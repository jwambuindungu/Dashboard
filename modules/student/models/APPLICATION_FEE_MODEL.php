<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 30-Jun-17
 * Time: 11:13
 */

namespace app\modules\student\models;


use app\components\DATA_INTERVAL;
use yii\db\ActiveRecord;

class APPLICATION_FEE_MODEL extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'MUTHONI.APPLICATION_RECEIPT';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return \Yii::$app->get('muthoni_orcl');
    }


    public static function COLLEGE_APPLICATION_FEES( $currency = 'KES',$duration = 0)
    {
        DATA_INTERVAL::$DATE_FORMAT = 'd-M-Y';


        $duration = -1 * ($duration);
        $interval = DATA_INTERVAL::DAY_INTERVAL;
        $duration = DATA_INTERVAL::COMPUTE_DATE_RANGE($duration, $interval);


        $application_fee_query = <<<FEE_QUERY
SELECT ALL
		MUTHONI.COLLEGES.COL_CODE,   
		COUNT(MUTHONI.APPLICANT.APPLICATION_NO) COUNT_STUDENTS, 
		SUM(MUTHONI.APPLICATION_RECEIPT.AMOUNT) SUM_AMOUNT,
		SUM(decode(NVL(MUTHONI.APPLICANT.STATUS,'X'),'ADMISSABLE',1,0)) AS ADMISSABLE,
		SUM(decode(NVL(MUTHONI.APPLICANT.REGISTRATION_NUMBER,'X'),'X',0,1)) AS REPORTED
		FROM MUTHONI.APPLICANT, MUTHONI.COLLEGES, MUTHONI.FACULTIES, 
		MUTHONI.DEGREE_PROGRAMMES, MUTHONI.APPLICATION_RECEIPT
		WHERE ( 
		TO_DATE(TO_CHAR(MUTHONI.APPLICANT.DATE_APPLIED,'DD-MON-YYYY'),'DD-MON-YYYY') >= TO_DATE('$duration->START_DATE', 'DD-MON-YYYY')
		AND TO_DATE(TO_CHAR(MUTHONI.APPLICANT.DATE_APPLIED,'DD-MON-YYYY'),'DD-MON-YYYY')<=TO_DATE('$duration->END_DATE', 'DD-MON-YYYY') 
		)
		AND MUTHONI.APPLICATION_RECEIPT.CURRENCY = '$currency'
		AND (NVL(MUTHONI.APPLICATION_RECEIPT.RECEIPT_STATUS, 'X')<>'CANCELLED')
		AND((MUTHONI.FACULTIES.COL_CODE=MUTHONI.COLLEGES.COL_CODE)
		AND (MUTHONI.DEGREE_PROGRAMMES.FACUL_FAC_CODE=MUTHONI.FACULTIES.FAC_CODE)
		AND (MUTHONI.APPLICANT.DEGREE_CODE=MUTHONI.DEGREE_PROGRAMMES.DEGREE_CODE)
		AND (MUTHONI.APPLICANT.APPLICATION_NO=MUTHONI.APPLICATION_RECEIPT.APPLICATION_NO(+)))
		GROUP BY MUTHONI.COLLEGES.COL_CODE
		ORDER BY MUTHONI.COLLEGES.COL_CODE
FEE_QUERY;

        $command = self::getDb()->createCommand($application_fee_query);

        $fee_data = $command->queryAll();;
        $fee_data_sum = [];
        $transactions_sum = [];

        foreach ($fee_data as $key => $value) {
            $fee_object = (object)$value;
            $fee_data_sum[] = (float)$fee_object->SUM_AMOUNT;
            $transactions_sum[] = (int)$fee_object->COUNT_STUDENTS;
        }

        $fee_data[] = [
            'TOTAL_TRANSACTIONS' => array_sum($transactions_sum),
            'TOTAL_FEES' => array_sum($fee_data_sum),
        ];

        $formatter = \Yii::$app->formatter;

        $total = $formatter->asDecimal(array_sum($fee_data_sum), 2);
        return $total;

    }
}
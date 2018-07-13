<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 28-Jun-17
 * Time: 15:28
 */

namespace app\modules\student\models;


use app\components\DATA_INTERVAL;
use yii\db\ActiveRecord;
use yii\db\Query;

class FEE_REPORT_MODEL extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'MUTHONI.FEE_PAYMENTS';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return \Yii::$app->muthoni_orcl;
    }

    /**
     * @return array
     */
    public static function COLLEGE_SUMMARY_COLLECTIONS()
    {
        DATA_INTERVAL::$DATE_FORMAT = 'd-M-Y';


        $duration = '0';
        $interval = DATA_INTERVAL::DAY_INTERVAL;
        $duration = DATA_INTERVAL::COMPUTE_DATE_RANGE($duration, $interval);


        $receipt_number = '218';

        $fee_summary_query = <<<FEE_COL_SUMMARY
SELECT ALL 
	MUTHONI.FACULTIES.COL_CODE, 
	COUNT(MUTHONI.FEE_PAYMENTS.RECEIPT_NUMBER) NO_TRANS, 
	SUM(MUTHONI.FEE_PAYMENTS.TRANS_AMOUNT *NVL(MUTHONI.FEE_PAYMENTS.EXCHANGE_RATE,1)) SUM_AMOUNTS
FROM MUTHONI.UON_STUDENTS, 
	MUTHONI.DEGREE_PROGRAMMES, MUTHONI.FACULTIES, MUTHONI.FEE_PAYMENTS
WHERE ( TO_DATE(TO_CHAR(MUTHONI.FEE_PAYMENTS.TRANS_DATE,'DD-MON-YYYY'),'DD-MON-YYYY')>=TO_DATE('$duration->START_DATE', 'DD-MON-YYYY') AND 
TO_DATE(TO_CHAR(MUTHONI.FEE_PAYMENTS.TRANS_DATE,'DD-MON-YYYY'),'DD-MON-YYYY')<=TO_DATE('$duration->END_DATE', 'DD-MON-YYYY') AND 
MUTHONI.UON_STUDENTS.STC_STUDENT_CATEGORY_ID IN ('003', '004') AND 
NVL(MUTHONI.FEE_PAYMENTS.RECEIPT_STATUS, 'X')<>'CANCELLED' AND 
MUTHONI.FEE_PAYMENTS.RECEIPT_NUMBER LIKE '$receipt_number%' )AND  
((MUTHONI.UON_STUDENTS.D_PROG_DEGREE_CODE=MUTHONI.DEGREE_PROGRAMMES.DEGREE_CODE) AND 
(MUTHONI.DEGREE_PROGRAMMES.FACUL_FAC_CODE=MUTHONI.FACULTIES.FAC_CODE) AND 
(MUTHONI.FEE_PAYMENTS.REG_NUMBER=MUTHONI.UON_STUDENTS.REGISTRATION_NUMBER))
GROUP BY 
MUTHONI.FACULTIES.COL_CODE
FEE_COL_SUMMARY;


        $command = self::getDb()->createCommand($fee_summary_query);

        $fee_data = $command->queryAll();;
        $fee_data_sum = [];
        $transactions_sum = [];

        foreach ($fee_data as $key => $value) {
            $fee_object = (object)$value;
            $fee_data_sum[] = (float)$fee_object->SUM_AMOUNTS;
            $transactions_sum[] = (int)$fee_object->NO_TRANS;
        }

        $fee_data[] = [
            'TOTAL_TRANSACTIONS' => array_sum($transactions_sum),
            'TOTAL_FEES' => array_sum($fee_data_sum),
        ];

        $formatter = \Yii::$app->formatter;

        $total = $formatter->asDecimal( array_sum($fee_data_sum),2);
        return $total;
    }
}
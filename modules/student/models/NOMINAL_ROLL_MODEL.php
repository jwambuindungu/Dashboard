<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 28-Jun-17
 * Time: 15:28
 */

namespace app\modules\student\models;


use app\components\DATA_INTERVAL;
use yii\data\ArrayDataProvider;
use yii\db\ActiveRecord;
use yii\db\Query;

class NOMINAL_ROLL_MODEL extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'MUTHONI.ACADEMIC_YEAR_PROGRESS';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return \Yii::$app->muthoni_orcl;
    }

    public static function NOMINAL_AC_YEAR()
    {
        $academic_year_roll = <<<NOMINAL
SELECT
	*
FROM
	(
		SELECT
			MUTHONI.ACADEMIC_YEAR_PROGRESS.ACADEMIC_YEAR,
			MUTHONI.UON_STUDENTS.SEX
		FROM
			MUTHONI.UON_STUDENTS,
			MUTHONI.ACADEMIC_YEAR_PROGRESS,
			MUTHONI.DEGREE_PROGRAMMES,
			MUTHONI.FACULTIES
		WHERE
			MUTHONI.UON_STUDENTS.REGISTRATION_NUMBER = MUTHONI.ACADEMIC_YEAR_PROGRESS.REGISTRATION_NUMBER
		AND MUTHONI.UON_STUDENTS.D_PROG_DEGREE_CODE = MUTHONI.DEGREE_PROGRAMMES.DEGREE_CODE
		AND MUTHONI.ACADEMIC_YEAR_PROGRESS.ACADEMIC_YEAR IN (
			'2012/2013',
			'2013/2014',
			'2014/2015',
			'2015/2016',
			'2016/2017',
			'2017/2018'			
		)
		AND NVL(MUTHONI.UON_STUDENTS.STUDENT_STATUS,'001') <>'009'
		AND DEGREE_PROGRAMMES.FACUL_FAC_CODE = FACULTIES.FAC_CODE
	) PIVOT (
		COUNT (*) FOR SEX IN ('F' AS FEMALE, 'M' AS MALE)
	)
ORDER BY
	ACADEMIC_YEAR
NOMINAL;


        $command = self::getDb()->createCommand($academic_year_roll);

        $nominal_data = $command->queryAll();;


        return $nominal_data;
    }

    public static function NOMINAL_AC_YEAR_DATA_TABLE($return_array = false)
    {
        $formatter = \Yii::$app->formatter;


        $data = self::NOMINAL_AC_YEAR();
        $stat_arr = [];
        foreach ($data as $list => $query_item) {
            $obj = (object)$query_item;
            $intake_sum = (int)$obj->MALE + (int)$obj->FEMALE;
            $stat_arr[] = [
                'ACADEMIC_YEAR' => $obj->ACADEMIC_YEAR,
                'MALE' => $obj->MALE,
                'FEMALE' => $obj->FEMALE,
                'SUB_TOTAL' =>$formatter->asDecimal($intake_sum, 0)
            ];
        }


        $array_data = new ArrayDataProvider([
            'allModels' => $stat_arr,
            'pagination' => [
                'pageSize' => 50,
            ],
            'sort' => [
                'attributes' => [
                    'ACADEMIC_YEAR'
                ],
            ],
        ]);

        return $return_array ? $stat_arr : $array_data;
    }

    /**
     * @return array
     */
	 
		 
    public static function NOMINAL_COLLEGE_PROG_SUMMARY($ac_year)
    {

        $nominal_roll_query = <<<FEE_COL_SUMMARY
        SELECT
	*
FROM
	(
		SELECT
			MUTHONI.ACADEMIC_YEAR_PROGRESS.ACADEMIC_YEAR,
			MUTHONI.FACULTIES.COL_CODE,
			MUTHONI.DEGREE_PROGRAMMES.DEGREE_CODE,
			MUTHONI.DEGREE_PROGRAMMES.DEGREE_NAME,
			MUTHONI.UON_STUDENTS.SEX
		FROM
			MUTHONI.UON_STUDENTS,
			MUTHONI.ACADEMIC_YEAR_PROGRESS,
			MUTHONI.DEGREE_PROGRAMMES,
			MUTHONI.FACULTIES
			
		WHERE
			MUTHONI.UON_STUDENTS.REGISTRATION_NUMBER = MUTHONI.ACADEMIC_YEAR_PROGRESS.REGISTRATION_NUMBER
		AND MUTHONI.UON_STUDENTS.D_PROG_DEGREE_CODE = MUTHONI.DEGREE_PROGRAMMES.DEGREE_CODE
		AND MUTHONI.ACADEMIC_YEAR_PROGRESS.ACADEMIC_YEAR = '$ac_year'
	    AND NVL(MUTHONI.UON_STUDENTS.STUDENT_STATUS,'001') <>'009'
		AND DEGREE_PROGRAMMES.FACUL_FAC_CODE = FACULTIES.FAC_CODE
	) PIVOT (
		COUNT (*) FOR SEX IN ('F' AS F, 'M' AS M)
	)
ORDER BY
	COL_CODE
FEE_COL_SUMMARY;


        $command = self::getDb()->createCommand($nominal_roll_query);

        $nominal_data = $command->queryAll();;

        return $nominal_data;
    }

    public static function BUILD_COLLEGE_NOMINAL_TABLE($data)
    {
        $test = [];
        foreach ($data as $key => $arr) {
            $arrObject = (object)$arr;
            $test[$arrObject->DEGREE_CODE][$arrObject->ACADEMIC_YEAR] = [
                'M' => $arrObject->M,
                'F' => $arrObject->F,

            ];

        }

        $table = '<table border="1" width="50%">';

        $header_tracker = [];
        $sub_total_gender = [];
        foreach ($test as $col_code => $row) {
            $table .= '<tr>';
            $table .= '<td>' . array_sum($sub_total_gender) . '</td>';
            $sub_total_gender = [];
            foreach ($row as $ac_year => $row2) {
                $obj2 = (object)$row2;
                $table .= '<td rowspan="2">';
                $table .= '<table class="table table-condensed">';
                //stuff here
                $sub_total_gender[] = (int)$obj2->M + ($obj2->F);
                if (!in_array($ac_year, $header_tracker)) {
                    $table .= '<tr><td colspan="2" align="center">' . $ac_year . '</td></tr>';
                    $table .= '<tr><td align="center">F</td><td align="center">M</td></tr>';
                    $header_tracker[] = $ac_year;
                }
                $table .= '<tr>';
                $table .= '<td align="center">' . $obj2->F . '</td>';
                $table .= '<td align="center">' . $obj2->M . '</td>';
                $table .= '</tr>';
                //end of stuff
                $table .= '</table>';
                $table .= '</td>';
            }
            $table .= '</tr>';
            $table .= '<tr><td>Degree Prog ' . $col_code . '</td></tr>';
        }
        $table .= '</table>';

        return $table;
    }

    public static function BUILD_NOMINAL_ARRAY_DATA($ac_year)
    {
        $data = self::NOMINAL_COLLEGE_PROG_SUMMARY($ac_year);

        $array_data = new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        return $array_data;
    }
}
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
		$db = self::getDb();
		$sql="SELECT COUNT(*) TOT
			FROM
			(
				SELECT $schema_name.EMPLOYEE.PAYROLL_NO
				FROM
					$schema_name.EMPLOYEE
					INNER JOIN $schema_name.ESTABLISHMENTS ON $schema_name.EMPLOYEE.POS_CODE = $schema_name.ESTABLISHMENTS.POS_CODE
					INNER JOIN $schema_name.DEPARTMENTS ON $schema_name.ESTABLISHMENTS.DEPT_CODE = $schema_name.DEPARTMENTS.DEPT_CODE
					INNER JOIN $schema_name.FACULTIES ON $schema_name.DEPARTMENTS.FAC_CODE = $schema_name.FACULTIES.FAC_CODE
					INNER JOIN $schema_name.COLLEGES ON $schema_name.FACULTIES.COL_CODE = $schema_name.COLLEGES.COL_CODE
					INNER JOIN $schema_name.GRADES ON $schema_name.EMPLOYEE.GRADE_CODE = $schema_name.GRADES.GRADE_CODE
					INNER JOIN $schema_name.JOB_TITLE ON $schema_name.ESTABLISHMENTS.TITLE_CODE = $schema_name.JOB_TITLE.TITLE_CODE
					INNER JOIN $schema_name.DESIGNATION ON $schema_name.JOB_TITLE.DSG_CODE = $schema_name.DESIGNATION.DSG_CODE

				WHERE 
				(
					$schema_name.EMPLOYEE.POS_STATUS NOT IN ('RETRENCHED', 'INACTIVE', 'DECEASED', 'RESIGNED', 'TERMINATED', 'UNAUTHORIZED', 'RETIRED', 'CONTRACT')
					AND (
						UPPER($schema_name.DESIGNATION.DSG_NAME) LIKE '%PROFESSOR%'
						OR UPPER($schema_name.DESIGNATION.DSG_NAME) LIKE '%ASSOCIATE PROF%'
						OR UPPER($schema_name.DESIGNATION.DSG_NAME) LIKE '%SENIOR LECTURER%'
						OR UPPER($schema_name.DESIGNATION.DSG_NAME) LIKE '%RESEARCH%'
						OR UPPER($schema_name.DESIGNATION.DSG_NAME) LIKE 'LECTURER%'
						OR UPPER($schema_name.DESIGNATION.DSG_NAME) LIKE '%ASSISTANT LECTURER%'
						OR UPPER($schema_name.DESIGNATION.DSG_NAME) LIKE '%TUTORIAL FELLOW%'
						OR UPPER($schema_name.DESIGNATION.DSG_NAME) LIKE '%GRADUATE ASSISTANT%'
						OR UPPER(DESIGNATION.DSG_NAME) = 'PRINCIPAL'
					)
				)
			)";
		$model = $db->createCommand($sql);
		$data = $model->queryScalar();
		
        return $data;
    }

    public static function NTSCOUNT($schema_name = 'P15_2680_94') // Non-Teaching Staff
    {
		$db = self::getDb();
		$sql="SELECT COUNT(*) TOT
			FROM
			(
				SELECT $schema_name.EMPLOYEE.PAYROLL_NO
				FROM
					$schema_name.EMPLOYEE
					INNER JOIN $schema_name.ESTABLISHMENTS ON $schema_name.EMPLOYEE.POS_CODE = $schema_name.ESTABLISHMENTS.POS_CODE
					INNER JOIN $schema_name.DEPARTMENTS ON $schema_name.ESTABLISHMENTS.DEPT_CODE = $schema_name.DEPARTMENTS.DEPT_CODE
					INNER JOIN $schema_name.FACULTIES ON $schema_name.DEPARTMENTS.FAC_CODE = $schema_name.FACULTIES.FAC_CODE
					INNER JOIN $schema_name.COLLEGES ON $schema_name.FACULTIES.COL_CODE = $schema_name.COLLEGES.COL_CODE
					INNER JOIN $schema_name.GRADES ON $schema_name.EMPLOYEE.GRADE_CODE = $schema_name.GRADES.GRADE_CODE
					INNER JOIN $schema_name.JOB_TITLE ON $schema_name.ESTABLISHMENTS.TITLE_CODE = $schema_name.JOB_TITLE.TITLE_CODE
					INNER JOIN $schema_name.DESIGNATION ON $schema_name.JOB_TITLE.DSG_CODE = $schema_name.DESIGNATION.DSG_CODE

				WHERE 
				(
					$schema_name.EMPLOYEE.POS_STATUS NOT IN ('RETRENCHED', 'INACTIVE', 'DECEASED', 'RESIGNED', 'TERMINATED', 'UNAUTHORIZED', 'RETIRED', 'CONTRACT')
					AND (
						UPPER(DESIGNATION.DSG_NAME) NOT LIKE '%PROFESSOR%' AND UPPER(DESIGNATION.DSG_NAME) NOT LIKE '%ASSOCIATE PROF%'  
						AND UPPER(DESIGNATION.DSG_NAME) NOT LIKE '%SENIOR LECTURER%' AND UPPER(DESIGNATION.DSG_NAME) NOT LIKE '%RESEARCH%'  
						AND UPPER(DESIGNATION.DSG_NAME) NOT LIKE 'LECTURER%'  AND UPPER(DESIGNATION.DSG_NAME) NOT LIKE '%ASSISTANT LECTURER%'  
						AND UPPER(DESIGNATION.DSG_NAME) NOT LIKE '%TUTORIAL FELLOW%'  AND UPPER(DESIGNATION.DSG_NAME) NOT LIKE '%GRADUATE ASSISTANT%'
						AND UPPER(DESIGNATION.DSG_NAME) NOT LIKE '%DEPUTY VICE-CHANCELLOR%'
						AND UPPER(DESIGNATION.DSG_NAME) NOT LIKE '%PROJECT STAFF%'
						AND UPPER(DESIGNATION.DSG_NAME) <> 'PRINCIPAL'
					)
				)
			)";
		$model = $db->createCommand($sql);
		$data = $model->queryScalar();
		
        return $data;
    }

    public static function COLSTAFF($schema_name = 'P15_2680_94') // College Staff Count
    {
		$db = self::getDb();
		$sql="SELECT COUNT(*) TOT,COL_NAME
			FROM
			(
				SELECT $schema_name.EMPLOYEE.PAYROLL_NO,COLLEGES.COL_NAME
				FROM
					$schema_name.EMPLOYEE
					INNER JOIN $schema_name.ESTABLISHMENTS ON $schema_name.EMPLOYEE.POS_CODE = $schema_name.ESTABLISHMENTS.POS_CODE
					INNER JOIN $schema_name.DEPARTMENTS ON $schema_name.ESTABLISHMENTS.DEPT_CODE = $schema_name.DEPARTMENTS.DEPT_CODE
					INNER JOIN $schema_name.FACULTIES ON $schema_name.DEPARTMENTS.FAC_CODE = $schema_name.FACULTIES.FAC_CODE
					INNER JOIN $schema_name.COLLEGES ON $schema_name.FACULTIES.COL_CODE = $schema_name.COLLEGES.COL_CODE
					INNER JOIN $schema_name.GRADES ON $schema_name.EMPLOYEE.GRADE_CODE = $schema_name.GRADES.GRADE_CODE
					INNER JOIN $schema_name.JOB_TITLE ON $schema_name.ESTABLISHMENTS.TITLE_CODE = $schema_name.JOB_TITLE.TITLE_CODE
					INNER JOIN $schema_name.DESIGNATION ON $schema_name.JOB_TITLE.DSG_CODE = $schema_name.DESIGNATION.DSG_CODE

				WHERE 
				$schema_name.EMPLOYEE.POS_STATUS NOT IN ('RETRENCHED', 'INACTIVE', 'DECEASED', 'RESIGNED', 'TERMINATED', 'UNAUTHORIZED', 'RETIRED', 'CONTRACT')
			)
			GROUP BY COL_NAME
			ORDER BY COL_NAME";
		$model = $db->createCommand($sql);
		$data = $model->queryAll();
		
        return $data;
    }

    public static function GENDERCOLSTAFF($schema_name = 'P15_2680_94') // College Staff Count per Gender
    {
		$db = self::getDb();
		$sql="SELECT * FROM (
			SELECT COUNT(*) TOT,COL_NAME,SEX FROM (
			SELECT $schema_name.EMPLOYEE.PAYROLL_NO,COLLEGES.COL_NAME,SEX
			FROM
			$schema_name.EMPLOYEE
			INNER JOIN $schema_name.ESTABLISHMENTS ON $schema_name.EMPLOYEE.POS_CODE = $schema_name.ESTABLISHMENTS.POS_CODE
			INNER JOIN $schema_name.DEPARTMENTS ON $schema_name.ESTABLISHMENTS.DEPT_CODE = $schema_name.DEPARTMENTS.DEPT_CODE
			INNER JOIN $schema_name.FACULTIES ON $schema_name.DEPARTMENTS.FAC_CODE = $schema_name.FACULTIES.FAC_CODE
			INNER JOIN $schema_name.COLLEGES ON $schema_name.FACULTIES.COL_CODE = $schema_name.COLLEGES.COL_CODE
			INNER JOIN $schema_name.GRADES ON $schema_name.EMPLOYEE.GRADE_CODE = $schema_name.GRADES.GRADE_CODE
			INNER JOIN $schema_name.JOB_TITLE ON $schema_name.ESTABLISHMENTS.TITLE_CODE = $schema_name.JOB_TITLE.TITLE_CODE
			INNER JOIN $schema_name.DESIGNATION ON $schema_name.JOB_TITLE.DSG_CODE = $schema_name.DESIGNATION.DSG_CODE

			WHERE 
			$schema_name.EMPLOYEE.POS_STATUS NOT IN ('RETRENCHED', 'INACTIVE', 'DECEASED', 'RESIGNED', 'TERMINATED', 'UNAUTHORIZED', 'RETIRED', 'CONTRACT')
			)
			GROUP BY COL_NAME,SEX
			)
			PIVOT (
					min(TOT)
					FOR
					SEX
					IN('MALE' AS MALE ,'FEMALE' AS FEMALE)
			)
			ORDER BY COL_NAME";
		$model = $db->createCommand($sql);
		$data = $model->queryAll();
		
        return $data;
    }
}
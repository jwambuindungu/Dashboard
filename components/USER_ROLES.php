<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 13-Jun-17
 * Time: 09:45
 */

namespace app\components;


class USER_ROLES
{
    /**
     * Defined roles for users
     */
    CONST VC_ROLE = 'VC_ROLE';
    CONST DVC_RPE_ROLE = 'DVC_RPE_ROLE';
    CONST DVC_SA_ROLE = 'DVC_SA_ROLE';
    CONST DVC_AF_ROLE = 'DVC_AF_ROLE';
    CONST UMB_ROLE = 'UMB_ROLE';
    CONST COLLEGE_PRINCIPAL = 'COLLEGE_PRINCIPAL';


    public static function IS_ROLE_GRANTED($payroll_no, $role_name)
    {
        $db = \Yii::$app->muthoni_db;

        $role_query = <<<ROLE_CHECKER
SELECT GRANTED_ROLE FROM USER_ROLE_PRIVS WHERE (upper(USERNAME) =upper('$payroll_no') AND GRANTED_ROLE = '$role_name')
ROLE_CHECKER;


        // return $role_query;

        $command = $db->createCommand($role_query);

        $row_data = $command->queryAll();

        return count($row_data) <= 0 ? false : true;
    }
}
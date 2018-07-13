<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 13-Jul-17
 * Time: 10:06
 */

namespace app\components;


use yii\base\Exception;

class COMMON_AUTH
{
    public $db;
    public $username;
    public $password;

    public function IS_LOGIN_VALID($username, $password)
    {
        $resp = $this->LOGIN($username, $password);
        return $resp;
    }

    public function SET_USER_DETAILS()
    {
        \Yii::$app->session->set('user.username', $this->username);
        \Yii::$app->session->set('user.password', $this->password);

        $UserDetails =
            "SELECT * FROM P15_2680_94.EP_VIEW 
              WHERE (TRIM(PAYROLL_NO) =TRIM('$this->username')) 
              AND POS_STATUS IN ('ACTIVE','AGAINST')";

        $this->db->setFetchMode(ADODB_FETCH_ASSOC);
        $user_d = $this->db->GetRow($UserDetails);
         \Yii::$app->session->set('user_details', $user_d);
    }

    private function IS_DASH_USER()
    {
        $roles = \Yii::$app->session->get('roles');
        return in_array('DASHBOARD_USER',$roles);
    }

    private function SET_ROLES()
    {

        \Yii::$app->session->set('user.username', $this->username);
        \Yii::$app->session->set('user.password', $this->password);

        $UserRoles = "SELECT GRANTED_ROLE FROM USER_ROLE_PRIVS WHERE (upper(USERNAME) =upper('$this->username'))";
        //$rs = $this->db->Execute($UserRoles);

        $roles = [];
        $user_roles = $this->db->GetArray($UserRoles);
        foreach ($user_roles as $key => $Value) {
            $roles[] = $Value['GRANTED_ROLE'];
        }
        $session = \Yii::$app->session;

        // \Yii::$app->session->set('roles', $roles);
        $session['roles'] = $roles;
        //var_dump($_SESSION);
        //die;
    }

    private function LOGIN($username, $password)
    {
        $driver = 'oci8';
        $server = 'proddb.uonbi.ac.ke';
        $database = 'proddb';
        $port = 1521;
        $resp = [
            'username' => false,
            'message' => 'Invalid Username/Password',
        ];
        try {
            $this->db = ADONewConnection($driver); # eg. 'mysql' or 'oci8'

            //$db->debug = true;
            $this->db->Connect($server, $username, $password, $database);

            $this->username = $username;
            $this->password = $password;
            $resp = [
                'username' => $username,
                'message' => null
            ];
            //set the session variables

            $this->SET_ROLES();
            if(!$this->IS_DASH_USER()){
                $this->notUser();
                throw new Exception("You do not have the necessary rights to access this System!");
            }
            $this->SET_USER_DETAILS();

        } catch (\Exception $ex) {
            $resp = [
                'username' => false,
                'message' => $ex->getMessage()
            ];
        }

        return (object)$resp;
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    private function notUser()
    {
        $session = \Yii::$app->session;
        // destroys all data registered to a session.
        unset($session['user.username']);
        unset($session['user.password']);
        unset($session['roles']);
        unset($session['__id']);
        $session->destroy();
    }
}
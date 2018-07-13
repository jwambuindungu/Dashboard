<?php

namespace app\models;

use app\components\COMMON_AUTH;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property DASHBOARD_USERS|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Payroll Number',
            'password' => 'Password',
        ];
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username payroll no is integer
            [['username'], 'integer'],
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = new DASHBOARD_USERS();

            $resp = $user->validatePassword($this->username, $this->password);
            if ($resp->username === null || $resp->username === false) {
                $message = $resp->message != null ? $resp->message : 'Incorrect username or password.';
                $this->addError($attribute, $message);
            } else {
                //check if user exists in the dashboard users table after successful login
                $dashboard_user = $this->getUser();
                if ($dashboard_user === null) {
                    $this->addError($attribute, 'You are not authorized to access the dashboard');
                }
            }
        }
    }


    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser());
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return DASHBOARD_USERS|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = DASHBOARD_USERS::findByUsername($this->username); //User::findByUsername($this->username);
        }
        return $this->_user;
    }
}

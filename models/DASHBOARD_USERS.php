<?php

namespace app\models;

use app\components\COMMON_AUTH;
use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "DASHBOARD_USERS".
 *
 * @property string $PAYROLL_NO
 * @property string $SURNAME
 * @property string $OTHER_NAMES
 * @property integer $ACTIVE
 * @property string $AUTH_KEY
 * @property string $ACCESS_TOKEN
 */
class DASHBOARD_USERS extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $fullNames;
    public $accessToken;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'DASHBOARD.DASHBOARD_USERS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PAYROLL_NO', 'SURNAME', 'OTHER_NAMES'], 'required'],
            [['ACTIVE'], 'integer'],
            [['PAYROLL_NO'], 'string', 'max' => 40],
            [['SURNAME', 'OTHER_NAMES'], 'string', 'max' => 30],
            [['AUTH_KEY', 'ACCESS_TOKEN'], 'string', 'max' => 255],
            [['PAYROLL_NO'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PAYROLL_NO' => 'Payroll Number',
            'SURNAME' => 'Surname',
            'OTHER_NAMES' => 'Other Names',
            'ACTIVE' => 'Active',
            'AUTH_KEY' => 'Auth Key',
            'ACCESS_TOKEN' => 'Access Token',
        ];
    }

    //Authentication functions
    /** INCLUDE USER LOGIN VALIDATION FUNCTIONS**/
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    /* modified */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['ACCESS_TOKEN' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param  string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['PAYROLL_NO' => $username]);
    }


    public function getFullNames()
    {
        return $this->SURNAME . ' ' . $this->OTHER_NAMES;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->AUTH_KEY;
    }


    /**
     *
     *
     * @inheritdoc
     * @param string $authKey
     * @return bool
     **/
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string $username username to validate
     * @param  string $password password to validate
     * @return object if password provided is valid for current user
     */
    public function validatePassword($username, $password)
    {
        $common = new COMMON_AUTH();
        return $common->IS_LOGIN_VALID($username, $password);
    }
}

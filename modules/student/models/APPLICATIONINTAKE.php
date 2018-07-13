<?php

namespace app\modules\student\models;

use Yii;
use yii\data\ArrayDataProvider;
use yii\helpers\Json;
use yii\httpclient\Client;

/**
 * This is the model class for table "APPLICATION_INTAKE".
 *
 * @property string $INTAKE_CODE
 * @property string $ACADEMIC_YEAR
 * @property string $INTAKE_NAME
 * @property string $APPLICATION_DEADLINE
 * @property string $REPORTING_DATE
 * @property string $DEGREE_CODE
 * @property string $YEAR_REF
 * @property string $ADM_ACADEMIC_YEAR
 * @property string $START_DATE
 * @property string $END_DATE
 */
class APPLICATIONINTAKE extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'MUTHONI.APPLICATION_INTAKE';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('muthoni_orcl');
    }


    /**
     * @param $intake_name
     * @param $start_date
     * @param $end_date
     * @return mixed
     */
    public static function GET_PROG_DETAIL_INTAKE_STATS($intake_name, $col_code, $start_date, $end_date)
    {
        $api_url = Yii::$app->params['onlineapp_api'];
        $api_user = Yii::$app->params['api_user'];
        $api_token = Yii::$app->params['api_token'];

        $postData = [
            'col_code' => $col_code,
            'intake_name' => $intake_name,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'username' => $api_user,
            'password' => $api_token,
        ];

        $client = new Client(['baseUrl' => $api_url]);
        $payload = $client->createRequest()
            ->addHeaders(['content-type' => 'application/json'])
            ->setUrl('progintake')
            ->setMethod('post')
            ->setOptions([
                'timeout' => 30, // set timeout to 30 seconds for the case server is not responding
            ])
            ->setData($postData);

        $response = $payload->send();

        $data = Json::decode($response->content);

        if ($response->isOk) {

        }
        return $data;

    }

    /**
     * @param $intake_name
     * @param $start_date
     * @param $end_date
     * @return mixed
     */
    public static function GET_COL_DETAIL_INTAKE_STATS($intake_name, $start_date, $end_date)
    {
        $api_url = Yii::$app->params['onlineapp_api'];
        $api_user = Yii::$app->params['api_user'];
        $api_token = Yii::$app->params['api_token'];

        $postData = [
            'intake_name' => $intake_name,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'username' => $api_user,
            'password' => $api_token,
        ];

        $client = new Client(['baseUrl' => $api_url]);
        $payload = $client->createRequest()
            ->addHeaders(['content-type' => 'application/json'])
            ->setUrl('colintake')
            ->setMethod('post')
            ->setOptions([
                'timeout' => 30, // set timeout to 30 seconds for the case server is not responding
            ])
            ->setData($postData);

        $response = $payload->send();

        $data = Json::decode($response->content);

        if ($response->isOk) {

        }
        return $data;

    }

    /**
     * @param $intake_name
     * @param $deg_code
     * @param $status
     * @param $start_date
     * @param $end_date
     * @return mixed
     */
    public static function GET_DETAIL_PROG_INTAKE_STATS($intake_name, $deg_code, $status, $start_date, $end_date)
    {
        $api_url = Yii::$app->params['onlineapp_api'];
        $api_user = Yii::$app->params['api_user'];
        $api_token = Yii::$app->params['api_token'];

        $postData = [
            'intake_name' => $intake_name,
            'deg_code' => $deg_code,
            'status' => $status,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'username' => $api_user,
            'password' => $api_token,
        ];

        $client = new Client(['baseUrl' => $api_url]);
        $payload = $client->createRequest()
            ->addHeaders(['content-type' => 'application/json'])
            ->setUrl('progapplicant')
            ->setMethod('post')
            ->setOptions([
                'timeout' => 30, // set timeout to 30 seconds for the case server is not responding
            ])
            ->setData($postData);

        $response = $payload->send();

        $data = Json::decode($response->content);

        if ($response->isOk) {

        }
        return $data;

    }

    /**
     * @param $intake_name
     * @param $col_code
     * @param $start_date
     * @param $end_date
     * @return array
     */
    public static function BUILD_PROG_CHART_DATA($intake_name, $col_code, $start_date, $end_date)
    {
        $data = self::GET_PROG_DETAIL_INTAKE_STATS($intake_name, $col_code, $start_date, $end_date);

        $labels = [];
        $complete = [];
        $incomplete = [];
        asort($data); //sort alphabetically
        foreach ($data as $key => $value) {
            $obj = (object)$value;
            //var_dump($obj);die;
            $labels[] = $obj->PROGRAMME_NAME;
            $complete[] = $obj->COMPLETE_APPLICATIONS;
            $incomplete[] = $obj->INCOMPLETE_APPLICATIONS;
        }

        $chartData = [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'COMPLETE APPLICATIONS (Applied for a course and Paid)',
                    'data' => $complete,
                    'borderColor' => '#00B21D',
                    'fill' => false,
                    'backgroundColor' => '#00B21D'
                ],
                [
                    'label' => 'INCOMPLETE APPLICATIONS (Applied for a course but not Paid)',
                    'data' => $incomplete,
                    'borderColor' => '#FF0000',
                    'fill' => false,
                    'backgroundColor' => '#FF0000'

                ]
            ]
        ];

        return $chartData;
    }


    /**
     * @param $intake_name
     * @param $start_date
     * @param $end_date
     * @return array
     */
    public static function BUILD_COL_DETAIL_CHART_DATA($intake_name, $start_date, $end_date)
    {
        $data = self::GET_DETAIL_PROG_INTAKE_STATS($intake_name, $start_date, $end_date);

        $labels = [];
        $complete = [];
        $incomplete = [];
        asort($data); //sort alphabetically
        foreach ($data as $key => $value) {
            $obj = (object)$value;
            //var_dump($obj);die;
            $labels[] = $obj->COL_CODE;
            $complete[] = $obj->GENDER;
            $incomplete[] = $obj->COUNTRY_NAME;
        }

        $chartData = [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'COMPLETE APPLICATIONS (Applied for a course and Paid)',
                    'data' => $complete,
                    'borderColor' => '#00B21D',
                    'fill' => false,
                    'backgroundColor' => '#00B21D'
                ],
                [
                    'label' => 'INCOMPLETE APPLICATIONS (Applied for a course but not Paid)',
                    'data' => $incomplete,
                    'borderColor' => '#FF0000',
                    'fill' => false,
                    'backgroundColor' => '#FF0000'

                ]
            ]
        ];

        return $chartData;
    }


    /**
     * @param $intake_name
     * @param $start_date
     * @param $end_date
     * @return ArrayDataProvider
     */
    public static function BUILD_COL_DETAIL_TABLE_DATA($intake_name, $start_date, $end_date)
    {

        $data = self::GET_COL_DETAIL_INTAKE_STATS($intake_name, $start_date, $end_date);

        $array_data = new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => [
                'pageSize' => 50,
            ],
            'sort' => [
                'attributes' => [
                    'COL_CODE',
                    'INTAKE_NAME',
                    'COMPLETE_APPLICATIONS',
                    'INCOMPLETE_APPLICATIONS',
                    'INTAKE_TOTAL'
                ],
            ],
        ]);

        return $array_data;
    }

    /**
     * @param $intake_name
     * @param $start_date
     * @param $end_date
     * @return ArrayDataProvider
     */

    public static function BUILD_PROG_TABLE_DATA($intake_name, $col_code, $start_date, $end_date)
    {

        $data = self::GET_PROG_DETAIL_INTAKE_STATS($intake_name, $col_code, $start_date, $end_date);


        $array_data = new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => ['PROGRAMME_NAME', 'INTAKE_NAME', 'COMPLETE_APPLICATIONS', 'INCOMPLETE_APPLICATIONS', 'INTAKE_TOTAL'],
            ],
        ]);

        return $array_data;
    }

    /**
     * @param $intake_name
     * @param $deg_code
     * @param $status
     * @param $start_date
     * @param $end_date
     * @return array
     */
    public static function BUILD_PROG_INTAKE_CHART_DATA($intake_name, $deg_code, $status, $start_date, $end_date)
    {
        $data = self::GET_DETAIL_PROG_INTAKE_STATS($intake_name, $deg_code, $status, $start_date, $end_date);

        $labels = [];
        $complete = [];
        $incomplete = [];
        asort($data); //sort alphabetically
        foreach ($data as $key => $value) {
            $obj = (object)$value;
            //var_dump($obj);die;
            $labels[] = $obj->PROGRAMME_NAME;
            $complete[] = $obj->GENDER;
            $incomplete[] = $obj->COUNTRY_NAME;
        }

        $chartData = [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'COMPLETE APPLICATIONS (Applied for a course and Paid)',
                    'data' => $complete,
                    'borderColor' => '#00B21D',
                    'fill' => false,
                    'backgroundColor' => '#00B21D'
                ],
                [
                    'label' => 'INCOMPLETE APPLICATIONS (Applied for a course but not Paid)',
                    'data' => $incomplete,
                    'borderColor' => '#FF0000',
                    'fill' => false,
                    'backgroundColor' => '#FF0000'

                ]
            ]
        ];

        return $chartData;
    }


    /**
     * @param $intake_name
     * @param $deg_code
     * @param $status
     * @param $start_date
     * @param $end_date
     * @return ArrayDataProvider
     */
    public static function BUILD_PROG_INTAKE_TABLE_DATA($intake_name, $deg_code, $status, $start_date, $end_date)
    {

        $data = self::GET_DETAIL_PROG_INTAKE_STATS($intake_name, $deg_code, $status, $start_date, $end_date);

        $array_data = new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => [
                'pageSize' => 50,
            ],
            'sort' => [
                'attributes' => [
                    'APPLICATION_REF_NO',
                    'APPLICANT_NAME',
                    'GENDER',
                    'COUNTRY_NAME',
                    'EMAIL_ADDRESS',
                    'MOBILE_NO',
                    'APPLICATION_DATE'
                ],
            ],
        ]);

        return $array_data;
    }
}

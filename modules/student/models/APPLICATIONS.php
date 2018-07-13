<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 16-Jun-17
 * Time: 10:39
 */

namespace app\modules\student\models;

use Yii;
use yii\data\ArrayDataProvider;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\helpers\Json;
use yii\httpclient\Client;
use app\components\DATA_INTERVAL;

class APPLICATIONS extends ActiveRecord
{
    public static $date_range_obj;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'onlineapp.app_application';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->onlineapp;
        //return Yii::$app->get('onlineapp');
    }


    /**
     * @param $duration_back
     * @param $duration_name
     * @param $schema_name
     * @return Json
     */
    public static function GET_INTAKE_STATS($duration_back, $duration_name, $schema_name)
    {
        $api_url = Yii::$app->params['onlineapp_api'];
        $api_user = Yii::$app->params['api_user'];
        $api_token = Yii::$app->params['api_token'];


        self::$date_range_obj = DATA_INTERVAL::COMPUTE_DATE_RANGE($duration_back, $duration_name);
        $postData = [
            'start_date' => self::$date_range_obj->START_DATE,
            'end_date' => self::$date_range_obj->END_DATE,
            'username' => $api_user,
            'password' => $api_token,
        ];

        $client = new Client(['baseUrl' => $api_url]);
        $payload = $client->createRequest()
            ->addHeaders(['content-type' => 'application/json'])
            ->setUrl('intakestats')
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

    public static function GET_INTAKE_STATS_DEP($duration_back, $duration_name, $schema_name)
    {
        $start_date = DATA_INTERVAL::COMPUTE_DATA_DATE_RANGE($duration_back, $duration_name);

        $current_date = date(DATA_INTERVAL::DATE_FORMAT);

        $columns = [
            'INTAKE_NAME',
            'SUM(CASE WHEN (app_application.PAYMENT_STATUS) = 1 THEN 1 ELSE 0 END) COMPLETE_APPLICATIONS',
            'SUM(CASE WHEN (app_application.PAYMENT_STATUS) = 0 THEN 1 ELSE 0 END) INCOMPLETE_APPLICATIONS'
        ];

        $query = new Query();
        $query->select($columns)
            ->from("$schema_name.app_application")
            ->join('INNER JOIN', "$schema_name.app_application_intake", "app_application.INTAKE_CODE = app_application_intake.INTAKE_CODE")
            ->join('INNER JOIN', "$schema_name.degree_programmes", "app_application_intake.DEGREE_CODE = degree_programmes.DEGREE_CODE")
            ->where(['BETWEEN', 'APPLICATION_DATE', $start_date, $current_date])
            ->groupBy(['INTAKE_NAME'])
            ->orderBy(['INTAKE_NAME' => SORT_DESC]);
        //->limit(5);


        $command = $query->createCommand(self::getDb());

        // die($command->rawSql);
        $data = $command->queryAll();;
        return $data;
    }

    /**
     * @param $duration_back
     * @param $duration_name
     * @param string $schema_name
     * @return array
     *
     * @deprecated
     */
    public static function GET_INTAKE_STATS_OLD($duration_back, $duration_name, $schema_name)
    {

        $connection = self::getDb();
        $start_date = DATA_INTERVAL::COMPUTE_DATA_DATE_RANGE($duration_back, $duration_name);

        $current_date = date(DATA_INTERVAL::DATE_FORMAT);

        $intake_stats = <<<MYSQL_INTAKE_STAT
SELECT 
app_application_intake.INTAKE_NAME AS INTAKE_NAME, 
SUM(CASE WHEN (app_application.PAYMENT_STATUS) = 1 THEN 1 ELSE 0 END) COMPLETE_APPLICATIONS, 
SUM(CASE WHEN (app_application.PAYMENT_STATUS) = 0 THEN 1 ELSE 0 END) INCOMPLETE_APPLICATIONS 
FROM onlineapp.app_applicant, 
$schema_name.app_application, 
$schema_name.degree_programmes, 
$schema_name.app_application_intake 
WHERE 
app_application.APPLICATION_DATE BETWEEN '$start_date' AND '$current_date'
AND app_applicant.APPLICANT_ID = app_application.APPLICANT_ID 
AND app_application_intake.INTAKE_CODE = app_application.INTAKE_CODE 
AND app_application_intake.DEGREE_CODE = degree_programmes.DEGREE_CODE 
GROUP BY app_application_intake.INTAKE_NAME 
ORDER BY app_application_intake.INTAKE_NAME
MYSQL_INTAKE_STAT;

        $command = $connection->createCommand($intake_stats);

        $data = $command->queryAll();;
        return $data;
    }
    public static function BUILD_CHART_DATA($duration_back, $duration_name, $schema_name = 'onlineapp')
    {
        $data = self::GET_INTAKE_STATS($duration_back, $duration_name, $schema_name);


        $labels = [];
        $complete = [];
        $incomplete = [];

        asort($data); //sort alphabetically
        foreach ($data as $key => $value) {
            $chartObject = (object)$value;
            $labels[] = $chartObject->INTAKE_NAME;
            $complete[] = $chartObject->COMPLETE_APPLICATIONS;
            $incomplete[] = $chartObject->INCOMPLETE_APPLICATIONS;
        }

        $chartObject = new \stdClass();
        $chartObject->labels = $labels;
        $chartObject->complete = $complete;
        $chartObject->incomplete = $incomplete;

        return $chartObject;
    }

    public static function BUILD_TABLE_DATA($duration_back, $duration_name, $schema_name = 'onlineapp')
    {

        $data = self::GET_INTAKE_STATS($duration_back, $duration_name, $schema_name);

        $array_data = new ArrayDataProvider([
            'allModels' => $data,
            'sort' => [
                'attributes' => ['INTAKE_NAME', 'COMPLETE_APPLICATIONS', 'INCOMPLETE_APPLICATIONS', 'INTAKE_TOTAL'],
            ],
        ]);

        return $array_data;
    }
}
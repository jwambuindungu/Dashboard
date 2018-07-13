<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 28-Jun-17
 * Time: 12:40
 */

namespace app\components;

use Yii;
use yii\base\InvalidParamException;
use yii\helpers\Json;

class API_FACTORY
{
    protected $base_url;
    protected $client;
    protected $api_user;
    protected $api_token;

    public $timeout = 30; // set timeout to 30 seconds for the case server is not responding
    public $post_params = [];
    public $end_point;
    public $method = 'post';
    public $content_type = 'application/json';


    function __construct($end_point, $params)
    {
        $this->base_url = Yii::$app->params['onlineapp_api'];
        $this->api_user = Yii::$app->params['api_user'];
        $this->api_token = Yii::$app->params['api_token'];


        $this->post_params = $params;
        $this->client = new Client(['baseUrl' => $this->base_url]);
    }

    /**
     * @param $end_point
     * @param $params
     * @return array
     */
    public function CALL_END_POINT_ARRAY($end_point, $params)
    {
        if (!is_array($params)) {
            throw new InvalidParamException('Array expected', 401);
        }

        $json = $this->REST_CALL($end_point, $params);

        return Json::decode($json);

    }

    /**
     * @param $end_point
     * @param $params
     * @return Json
     */
    public function CALL_END_POINT_JSON($end_point, $params)
    {
        if (!is_array($params)) {
            throw new InvalidParamException('Array expected', 401);
        }

        return $this->REST_CALL($end_point, $params);

    }

    /**
     * @param $end_point
     * @param $params
     * @return mixed|Json
     */
    private function REST_CALL($end_point, $params)
    {

        $payload = $this->client->createRequest()
            ->addHeaders(['content-type' => $this->content_type])
            ->setUrl($end_point)
            ->setMethod($this->method)
            ->setOptions(['timeout' => $this->timeout,])
            ->setData($params);
        $response = $payload->send();

        $data = $response->content;

        return $data;
    }
}
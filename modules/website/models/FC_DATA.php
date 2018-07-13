<?php

namespace app\modules\website\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;


class FC_DATA extends ActiveRecord
{

    public static function WEBO_COLLEGE() // Staff about to retire
    {
        $cols = WEBDATA::COLLEGES();
        $dates = WEBDATA::DATES();

        $data = self::GET_GEN_STATS();

        $dataset = [];
        $fsdata = [];

        $labels = [
            'label'=>'PRESENCE',
            'label'=>'BACKLINKS',
            'label'=>'DOMAINS',
            'label'=>'CITATIONS',
        ];
        $m = [];
        $f = [];

        foreach ($data as $key => $value) {
            $obj = (object)$value;
//            $labels[] = ['label'=>self::ABBR_CNAME($obj->COL_NAME)];
            $m[] = ['value'=>$obj->MALE];
            $f[] = ['value'=>$obj->FEMALE];
            // $dataLb[] = [
            // 'label'=>self::ABBR_CNAME($obj->COL_NAME),
            // 'value'=>($obj->TOT)
            // ];
        }

        $dataset[]=["seriesname"=>"CURRENT","data"=>$m];
        $dataset[]=["seriesname"=>"PREVIOUS","data"=>$f];

        $graphData = [
            'type'=>'radar',
            'renderAt'=>'gender-graph',
            'width'=>'100%',
            'height'=>'100%',
            'dataFormat'=>'json',
            'dataSource'=>[
                "chart"=>[
                    "caption"=> "Webometrics",
                    "subCaption"=> "Current month",
                    "captionFontSize"=> "14",
                    "subcaptionFontSize"=> "14",
                    "numberPrefix"=>"$",
                    "baseFontColor" => "#333333",
                    "baseFont" => "Helvetica Neue,Arial",
                    "subcaptionFontBold"=> "0",
                    "paletteColors"=> "#008ee4,#6baa01",
                    "bgColor" => "#ffffff",
                    "radarfillcolor"=> "#ffffff",
                    "showBorder" => "0",
                    "showShadow" => "0",
                    "showCanvasBorder"=> "0",
                    "legendBorderAlpha"=> "0",
                    "legendShadow"=> "0",
                    "divLineAlpha"=> "10",
                    "usePlotGradientColor"=> "0",
                    "numberPreffix"=> "$",
                    "legendBorderAlpha"=> "0",
                    "legendShadow"=> "0",
                ],
                "categories"=>[
                    ["category"=>$labels],
                ],
                "dataset"=>$dataset,
            ]
        ];

        $fsdata = ['graph'=>$graphData];

        return $fsdata;
    }

}
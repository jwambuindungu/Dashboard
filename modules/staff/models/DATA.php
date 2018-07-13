<?php

namespace app\modules\staff\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\httpclient\Client;

use app\modules\staff\models\HR;


class DATA extends ActiveRecord
{
    // public static function GET_GENDER_STATS()
    // {
        // $data = HR::GENDERCOLSTAFF();
		
        // return $data;
    // }

    public static function GET_POP_STATS()
    {
        $data = HR::COLSTAFF();
		return $data;
	}

    public static function GET_COLAGE_STATS()
    {
        $data = HR::COLSTAFFAGE();
		return $data;
	}

    public static function GET_COLCATS_STATS()
    {
        $data = HR::COLSTAFFCAT();
		return $data;
	}

    public static function GET_CTRLSUMM($p='')
    {
		if(empty($p))
			$data = HR::CTRL_SUMM();
		else
			$data = HR::CTRL_VSUMM($p); // Variable
        return $data;
    }

    public static function GET_GEN_STATS()
    {
        $data = HR::COL_GENDER();
        return $data;
    }

    public static function GET_POP()
    {
        $data = HR::STAFFCOUNT();
        return $data;
    }

    public static function GET_POPTS()
    {
        $data = HR::TSCOUNT();
        return $data;
    }
	
    public static function GET_POPNTS()
    {
        $data = HR::NTSCOUNT();
        return $data;
    }
	
    public static function GET_POPPS()
    {
        $data = HR::PSCOUNT();
        return $data;
    }
	
    public static function GET_ETERMS()
    {
        $data = HR::EMP_TERMS();
        return $data;
    }
	
    public static function GET_EPOS()
    {
        $data = HR::EMP_POS();
        return $data;
    }
	
    public static function GET_PROFS()
    {
        $data = HR::PROF_STATS();
        return $data;
    }
	
    public static function GET_RETIRECOUNT()
    {
        $data = HR::EMP_RETIRE();
        return $data;
    }
	
	/*
	 * Generate and format Graph/Chart Data (Staff Population)
	 */
	
	public static function BUILD_GRAPH()
    {
        $data = self::GET_POP_STATS();

        $dataLb = [];
        $fsdata = [];
        foreach ($data as $key => $value) {
            $obj = (object)$value;
            $dataLb[] = [
				'label'=>self::ABBR_CNAME($obj->COL_NAME),
				'value'=>($obj->TOT)
			];
        }

        $graphData = [
			'type'=>'column2d',
			'renderAt'=>'staffpop-chart',
			'width'=>'100%',
			'height'=>'100%',
			'dataFormat'=>'json',
			'dataSource'=>[
				"chart"=>[
					"autoScale"=>"1",
					"caption"=>"Staff in Colleges",
					//"subCaption"=>"Last year",
					"xAxisName"=>"COLLEGE",
					"yAxisName"=>"No. of Staff",
					//"numberPrefix"=>"$",
					"canvasBgAlpha"=>"0",
					"bgColor"=>"#DDDDDD",
					"bgAlpha"=>"50",
					//"theme"=>"fint",
					"exportEnabled"=>"1",
				],
				"data"=>$dataLb,
			]
		];

        $donutData = [
			'type'=>'doughnut3d',
			'renderAt'=>'staffpop-donut',
			'width'=>'100%',
			'height'=>'100%',
			'dataFormat'=>'json',
			'dataSource'=>[
				"chart"=>[
					"autoScale"=>"1",
					"caption"=>"Staff in Colleges",
					"subCaption"=>"Active Staff",
					"numberPrefix"=>"$",
					//"paletteColors"=>"#0075c2,#1aaf5d,#f2c500,#f45b00,#8e0000",
					"exportEnabled"=>"1",
					"bgColor"=>"#ffffff",
					"showBorder"=>"0",
					"use3DLighting"=>"0",
					"showShadow"=>"0",
					"enableSmartLabels"=>"0",
					"startingAngle"=>"310",
					"showLabels"=>"0",
					"showPercentValues"=>"1",
					"showLegend"=>"1",
					"legendShadow"=>"0",
					"legendBorderAlpha"=>"0",                                
					"decimals"=>"0",
					"captionFontSize"=>"14",
					"subcaptionFontSize"=>"14",
					"subcaptionFontBold"=>"0",
					"toolTipColor"=>"#ffffff",
					"toolTipBorderThickness"=>"0",
					"toolTipBgColor"=>"#000000",
					"toolTipBgAlpha"=>"80",
					"toolTipBorderRadius"=>"2",
					"toolTipPadding"=>"5",
				],
				"data"=>$dataLb,
			]
		];
		
		$fsdata = ['graph'=>$graphData,'donut'=>$donutData];

        return $fsdata;
    }
	
	/*
	 * Generate and format Graph/Chart Data College Staff Gender Distribution
	 */
	
	public static function BUILD_CHART()
    {
        $data = self::GET_GEN_STATS();

        $dataset = [];
        $fsdata = [];
		
		$labels = [];
        $m = [];
        $f = [];
		
        foreach ($data as $key => $value) {
            $obj = (object)$value;
			$labels[] = ['label'=>self::ABBR_CNAME($obj->COL_NAME)];
            $m[] = ['value'=>$obj->MALE];
            $f[] = ['value'=>$obj->FEMALE];
            // $dataLb[] = [
				// 'label'=>self::ABBR_CNAME($obj->COL_NAME),
				// 'value'=>($obj->TOT)
			// ];
        }
		
		$dataset[]=["seriesname"=>"MALE","data"=>$m];
		$dataset[]=["seriesname"=>"FEMALE","data"=>$f];

        $graphData = [
			'type'=>'MSColumn3D',
			'renderAt'=>'gender-graph',
			'width'=>'100%',
			'height'=>'100%',
			'dataFormat'=>'json',
			'dataSource'=>[
				"chart"=>[
					"autoScale"=>"1",
					"showvalues"=>"0",
					"caption"=>"Staff Gender Distribution",
					// "numberprefix"=>"$",
					"xaxisname"=>"COLLEGES",
					"yaxisname"=>"Staff No.",
					"showBorder"=>"0",
					"paletteColors"=>"#0075c2,#ffb6c1",
					"exportEnabled"=>"1",
					"bgColor"=>"#ffffff",
					"canvasBgColor"=>"#fffff0",
					"captionFontSize"=>"14",
					"subcaptionFontSize"=>"14",
					"subcaptionFontBold"=>"0",
					"divlineColor"=>"#999999",
					"divLineIsDashed"=>"1",
					"divLineDashLen"=>"1",
					"divLineGapLen"=>"1",
					"toolTipColor"=>"#ffffff",
					"toolTipBorderThickness"=>"0",
					"toolTipBgColor"=>"#000000",
					"toolTipBgAlpha"=>"80",
					"toolTipBorderRadius"=>"2",
					"toolTipPadding"=>"5",
					"legendBgColor"=>"#ffffff",
					"legendBorderAlpha"=>'0',
					"legendShadow"=>'0',
					"legendItemFontSize"=>'10',
					"legendItemFontColor"=>'#666666'
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
	
	/*
	 * Generate and format Graph/Chart Data (Staff Age Dist - College)
	 */
	
	public static function BUILD_CAGES()
    {
        $data = self::GET_COLAGE_STATS();
		
        $dataset = [];
        $fsdata = [];
		
        $A = [];
        $B = [];
        $C = [];
		
        foreach ($data as $key => $value) {
            $obj = (object)$value;
			$labels[] = ['label'=>self::ABBR_CNAME($obj->COL_NAME)];
			$A[] = ['value'=>$obj->A];
			$B[] = ['value'=>$obj->B];
			$C[] = ['value'=>$obj->C];
        }
		
		$dataset[]=["seriesname"=>"Below 35","data"=>$A];
		$dataset[]=["seriesname"=>"35 to 64","data"=>$B];
		$dataset[]=["seriesname"=>"65 & Above","data"=>$C];

        $graphData = [
			'type'=>'msline',
			'renderAt'=>'colstaffage-chart',
			'width'=>'100%',
			'height'=>'100%',
			'dataFormat'=>'json',
			'dataSource'=>[
				"chart"=>[
					"caption"=>"STAFF AGE DISTRIBUTION IN COLLEGES",
					// "subcaption"=>"By Top 3 Vendors",
					"linethickness"=>"5",
					// "numberPrefix"=>"$",
					"showvalues"=>"0",
					"formatnumberscale"=>"1",
					"labeldisplay"=>"ROTATE",
					"slantlabels"=>"1",
					"divLineAlpha"=>"40",
					"anchoralpha"=>"0",
					"animation"=>"1",
					"legendborderalpha"=>"20",
					"drawCrossLine"=>"1",
					"crossLineColor"=>"#0d0d0d",
					"crossLineAlpha"=>"100",
					"tooltipGrayOutColor"=>"#80bfff",
					"theme"=>"zune",
					"exportEnabled"=>"1",
					"autoScale"=>"1",
				],
				"categories"=>[
					["category"=>$labels],
				],
				"dataset"=>$dataset,
			]
		];
		
		$fsdata = $graphData;

        return $fsdata;
    }
	
	/*
	 * Generate and format Graph/Chart Data (Staff Category Dist - College)
	 */
	
	public static function BUILD_SCATS()
    {
        $data = self::GET_COLCATS_STATS();
		
        $dataset = [];
        $fsdata = [];
		
        $T = [];
        $NTS = [];
        $P = [];
		
        foreach ($data as $key => $value) {
            $obj = (object)$value;
			$labels[] = ['label'=>self::ABBR_CNAME($obj->COL_NAME)];
			$TS[] = ['value'=>$obj->TS];
			$NTS[] = ['value'=>$obj->NTS];
			$P[] = ['value'=>$obj->P];
        }
		
		$dataset[]=["seriesname"=>"Teaching","data"=>$TS];
		$dataset[]=["seriesname"=>"Non-Teaching","data"=>$NTS];
		$dataset[]=["seriesname"=>"Project","data"=>$P];

        $graphData = [
			'type'=>'msline',
			'renderAt'=>'colstaffcat-chart',
			'width'=>'100%',
			'height'=>'100%',
			'dataFormat'=>'json',
			'dataSource'=>[
				"chart"=>[
					"caption"=>"STAFF BY CATEGORY IN COLLEGES",
					"linethickness"=>"5",
					"showvalues"=>"0",
					"formatnumberscale"=>"1",
					"labeldisplay"=>"ROTATE",
					"slantlabels"=>"1",
					"divLineAlpha"=>"40",
					"anchoralpha"=>"0",
					"animation"=>"1",
					"legendborderalpha"=>"20",
					"drawCrossLine"=>"1",
					"crossLineColor"=>"#0d0d0d",
					"crossLineAlpha"=>"100",
					"tooltipGrayOutColor"=>"#80bfff",
					"theme"=>"zune",
					"exportEnabled"=>"1",
					"autoScale"=>"1",
				],
				"categories"=>[
					["category"=>$labels],
				],
				"dataset"=>$dataset,
			]
		];
		
		$fsdata = $graphData;

        return $fsdata;
    }


	/*
	 * Generate and format Graph/Chart Data (Staff on Leave - College)
	 */

	public static function BUILD_SoL()
    {
        $data = STAFF_STUFF::GET_COL_SOLEAVE();

//        $dataset = [];
        $dataL = [];

//        $T = [];
//        $NTS = [];
//        $P = [];

        foreach ($data as $key => $value) {
            $obj = (object)$value;
            $dataL[] = [
			        'label'=>self::ABBR_CNAME($obj->COL_NAME),
			        'value'=>$obj->TOTAL,
                ];
//			$TS[] = ['value'=>$obj->TS];
//			$NTS[] = ['value'=>$obj->NTS];
//			$P[] = ['value'=>$obj->P];
        }

//		$dataset[]=["seriesname"=>"Teaching","data"=>$TS];
//		$dataset[]=["seriesname"=>"Non-Teaching","data"=>$NTS];
//		$dataset[]=["seriesname"=>"Project","data"=>$P];

        $graphData = [
			'type'=>'bar2d',
			'renderAt'=>'colsol-chart',
			'width'=>'100%',
			'height'=>'100%',
			'dataFormat'=>'json',
			'dataSource'=>[
				"chart"=>[
					"caption"=>"STAFF ON ANNUAL LEAVE IN COLLEGES",
//					"linethickness"=>"5",
//					"showvalues"=>"0",
//					"formatnumberscale"=>"1",
//					"labeldisplay"=>"ROTATE",
//					"slantlabels"=>"1",
//					"divLineAlpha"=>"40",
//					"anchoralpha"=>"0",
//					"animation"=>"1",
//					"legendborderalpha"=>"20",
//					"drawCrossLine"=>"1",
//					"crossLineColor"=>"#0d0d0d",
//					"crossLineAlpha"=>"100",
//					"tooltipGrayOutColor"=>"#80bfff",
////					"theme"=>"zune",
//					"exportEnabled"=>"1",
//					"autoScale"=>"1",

                    "subCaption"=> "As of Today",
                    "xAxisName"=> "Colleges",
                    "yAxisName"=> "No. of Staff",
                    "paletteColors"=> "#0075c2",
                    "bgColor"=> "#ffffff",
                    "showBorder"=> "0",
                    "showCanvasBorder"=> "0",
                    "usePlotGradientColor"=> "0",
                    "plotBorderAlpha"=> "10",
                    "placeValuesInside"=> "1",
                    "valueFontColor"=> "#ffffff",
                    "showAxisLines"=> "1",
                    "axisLineAlpha"=> "25",
                    "divLineAlpha"=> "10",
                    "alignCaptionWithCanvas"=> "0",
                    "showAlternateVGridColor"=> "0",
                    "captionFontSize"=> "14",
                    "subcaptionFontSize"=> "14",
                    "subcaptionFontBold"=> "0",
                    "toolTipColor"=> "#ffffff",
                    "toolTipBorderThickness"=> "0",
                    "toolTipBgColor"=> "#000000",
                    "toolTipBgAlpha"=> "80",
                    "toolTipBorderRadius"=> "2",
                    "toolTipPadding"=> "5",
					"exportEnabled"=>"1",
					"autoScale"=>"1",

				],
				"data"=>$dataL,
			]
		];

		$fsdata = $graphData;

        return $fsdata;
    }

	/*
	 * Generate and format Graph/Chart Data Control Summary
	 */
	
	public static function BUILD_CS()
    {
        $data = self::GET_CTRLSUMM();
		
        $dataset = [];
        $fsdata = [];
		
		$mon  = (int)$data['prdm'];
		$fmon  = strtoupper(date("F", mktime(0, 0, 0, (int)$mon, 10)));
		$fyr  = strtoupper(date("Y", mktime(0, 0, 0, 1, (int)$data['prdy'])));
		$m  = self::MNTH($mon);
		$m1 = self::MNTH($mon-1);
		$m2 = self::MNTH($mon-2);
		
		$labels []= ['label'=>$m2];
		$labels []= ['label'=>$m1];
		$labels []= ['label'=>$m];
		
		
        $gross = [];
        $ded = [];
        $net = [];
		
        foreach ($data['data'] as $key => $value) {
            $obj = (object)$value;
			// $labels[] = ['label'=>self::ABBR_CNAME($obj->COL_NAME)];
			if($obj->TRAN_NAME=='GROSS PAY'){
				$gross[] = ['value'=>$obj->PREV2];
				$gross[] = ['value'=>$obj->PREV1];
				$gross[] = ['value'=>$obj->CURR];
			}
			if($obj->TRAN_NAME=='TOTAL DEDUCTION'){
				$ded[] = ['value'=>$obj->PREV2];
				$ded[] = ['value'=>$obj->PREV1];
				$ded[] = ['value'=>$obj->CURR];
			}
			if($obj->TRAN_NAME=='NET PAY'){
				$net[] = ['value'=>$obj->PREV2];
				$net[] = ['value'=>$obj->PREV1];
				$net[] = ['value'=>$obj->CURR];
			}
			
            // $dataLb[] = [
				// 'label'=>self::ABBR_CNAME($obj->COL_NAME),
				// 'value'=>($obj->TOT)
			// ];
        }
		
		$dataset[]=["seriesname"=>"GROSS","data"=>$gross];
		$dataset[]=["seriesname"=>"DEDUCTIONS","data"=>$ded];
		$dataset[]=["seriesname"=>"NET","data"=>$net];

        $graphData = [
			'type'=>'MSarea',
			'renderAt'=>'controlsum-chart',
			'width'=>'100%',
			'height'=>'100%',
			'dataFormat'=>'json',
			'dataSource'=>[
				"chart"=>[
					"caption"=> $fmon.",".$fyr,
					"subCaption"=>"vs Last two months",
					"linethickness"=>"4",
					"exportEnabled"=>"1",
					"numberPrefix"=>"KSh.",
					"paletteColors"=>"#0075c2,#1aaf5d,#ff0000",
					"bgColor"=>"#ffffff",
					"showBorder"=>"0",
					"showCanvasBorder"=>"0",
					"plotBorderAlpha"=>"10",
					"usePlotGradientColor"=>"0",
					"autoScale"=>"1",
					"legendBorderAlpha"=>"0",
					"legendShadow"=>"0",
					"plotFillAlpha"=>"60",
					"showXAxisLine"=>"1",
					"axisLineAlpha"=>"25",                
					"showValues"=>"0",
					"captionFontSize"=>"14",
					"subcaptionFontSize"=>"14",
					"subcaptionFontBold"=>"0",
					"divlineColor"=>"#999999",                
					"divLineIsDashed"=>"1",
					"divLineDashLen"=>"1",
					"divLineGapLen"=>"1",
					"showAlternateHGridColor"=>"0",
					"toolTipColor"=>"#ffffff",
					"outCnvBaseFontColor"=>"#000000",
					"toolTipBorderThickness"=>"0",
					"toolTipBgColor"=>"#000000",
					"toolTipBgAlpha"=>"80",
					"toolTipBorderRadius"=>"2",
					"toolTipPadding"=>"5",
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
	
	/*
	 * Generate and format Graph/Chart Data Control Summary (Dynamic)
	 */
	
	public static function BUILD_VCS($prd_code)
    {
        $data = self::GET_CTRLSUMM($prd_code);
		
		// print_r($prd_code);exit;
		
        $dataset = [];
        $fsdata = [];
		
		$phMon = explode('/',$prd_code);
		$mon  = (int)$phMon[0];
		$fmon  = strtoupper(date("F", mktime(0, 0, 0, (int)$mon, 10)));
		$fyr  = strtoupper(date("Y", mktime(0, 0, 0, 1, 1, (int)$phMon[1])));
		$m  = self::MNTH($mon);
		$m1 = self::MNTH($mon-1);
		$m2 = self::MNTH($mon-2);
		
		$labels []= ['label'=>$m2];
		$labels []= ['label'=>$m1];
		$labels []= ['label'=>$m];
		
		
        $gross = [];
        $ded = [];
        $net = [];
		
        foreach ($data as $key => $value) {
            $obj = (object)$value;
			if($obj->TRAN_NAME=='GROSS PAY'){
				$gross[] = ['value'=>$obj->PREV2];
				$gross[] = ['value'=>$obj->PREV1];
				$gross[] = ['value'=>$obj->CURR];
			}
			if($obj->TRAN_NAME=='TOTAL DEDUCTION'){
				$ded[] = ['value'=>$obj->PREV2];
				$ded[] = ['value'=>$obj->PREV1];
				$ded[] = ['value'=>$obj->CURR];
			}
			if($obj->TRAN_NAME=='NET PAY'){
				$net[] = ['value'=>$obj->PREV2];
				$net[] = ['value'=>$obj->PREV1];
				$net[] = ['value'=>$obj->CURR];
			}
			
        }
		
		$dataset[]=["seriesname"=>"GROSS","data"=>$gross];
		$dataset[]=["seriesname"=>"DEDUCTIONS","data"=>$ded];
		$dataset[]=["seriesname"=>"NET","data"=>$net];

        $graphData = [
			'type'=>'MSarea',
			'renderAt'=>'controlsum-chart',
			'width'=>'100%',
			'height'=>'100%',
			'dataFormat'=>'json',
			'dataSource'=>[
				"chart"=>[
					"caption"=> $fmon.",".$fyr,
					"subCaption"=>"vs Last two months",
					"linethickness"=>"4",
					"exportEnabled"=>"1",
					"numberPrefix"=>"KSh.",
					"paletteColors"=>"#0075c2,#1aaf5d,#ff0000",
					"bgColor"=>"#ffffff",
					"showBorder"=>"0",
					"showCanvasBorder"=>"0",
					"plotBorderAlpha"=>"10",
					"usePlotGradientColor"=>"0",
					"autoScale"=>"1",
					"legendBorderAlpha"=>"0",
					"legendShadow"=>"0",
					"plotFillAlpha"=>"60",
					"showXAxisLine"=>"1",
					"axisLineAlpha"=>"25",                
					"showValues"=>"0",
					"captionFontSize"=>"14",
					"subcaptionFontSize"=>"14",
					"subcaptionFontBold"=>"0",
					"divlineColor"=>"#999999",                
					"divLineIsDashed"=>"1",
					"divLineDashLen"=>"1",
					"divLineGapLen"=>"1",
					"showAlternateHGridColor"=>"0",
					"toolTipColor"=>"#ffffff",
					"outCnvBaseFontColor"=>"#000000",
					"toolTipBorderThickness"=>"0",
					"toolTipBgColor"=>"#000000",
					"toolTipBgAlpha"=>"80",
					"toolTipBorderRadius"=>"2",
					"toolTipPadding"=>"5",
				],
				"categories"=>[
					["category"=>$labels],
				],
				"dataset"=>$dataset,
			]
		];
		
		$fsdata = $graphData;

        return $fsdata;
    }
	
	/*
	 * Generate and format Graph/Chart Data (No. of Professors)
	 */
	
	public static function DN_PROFS()
    {
        $data = self::GET_PROFS();

        $dataLb = [];
        $fsdata = [];
		
		$dataLb[] = ['label'=>'MALE','value'=>$data['MALE']];
		$dataLb[] = ['label'=>'FEMALE','value'=>$data['FEMALE']];

        $donutData = [
			'type'=>'doughnut3d',
			'renderAt'=>'prof-donut',
			'width'=>'100%',
			'height'=>'100%',
			'dataFormat'=>'json',
			'dataSource'=>[
				"chart"=>[
					"autoScale"=>"1",
					"caption"=>"Professors",
					"subCaption"=>"Active Staff",
					"numberPrefix"=>"$",
					//"paletteColors"=>"#0075c2,#1aaf5d,#f2c500,#f45b00,#8e0000",
					"exportEnabled"=>"1",
					"bgColor"=>"#ffffff",
					"showBorder"=>"0",
					"use3DLighting"=>"0",
					"showShadow"=>"0",
					"enableSmartLabels"=>"0",
					"startingAngle"=>"310",
					"showLabels"=>"0",
					"showPercentValues"=>"1",
					"showLegend"=>"1",
					"legendShadow"=>"0",
					"legendBorderAlpha"=>"0",                                
					"decimals"=>"0",
					"captionFontSize"=>"14",
					"subcaptionFontSize"=>"14",
					"subcaptionFontBold"=>"0",
					"toolTipColor"=>"#ffffff",
					"toolTipBorderThickness"=>"0",
					"toolTipBgColor"=>"#000000",
					"toolTipBgAlpha"=>"80",
					"toolTipBorderRadius"=>"2",
					"toolTipPadding"=>"5",
				],
				"data"=>$dataLb,
			]
		];
		
		$fsdata = ['donut'=>$donutData];

        return $fsdata;
    }
	
	public static function MNTH($mon)
    {
        $nm= strtoupper(date("M", mktime(0, 0, 0, (int)$mon, 10)));
        return $nm;
    }
	
	public static function ABBR_CNAME($cName,$c=true)
    {
        $nmD = strtoupper($cName);
		$a   = array("OF", "AND");
		$b   = array("", "");
		$forAcc = str_replace($a, $b, $nmD);
		$nm = preg_replace('~\b(\w)|.~', '$1', $forAcc);
		if(strlen($nm)<3)
			$nm=$nmD;
		if($c)
			if (strpos($nm, 'CENTRAL') !== false)
				$nm='CENTRAL';
			if (strpos($nm, 'ODEL') !== false)
				$nm='ODEL';
			if (strpos($nm, 'GRADUATE') !== false)
				$nm='GRAD SCH';

        return $nm;
    }
	
	private static function genColor($cnt)
    {
		$clres = [];
        $cl = ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850", "#bada55", "#00ffd2", "#97a7a8"];
		$clen = count($cl);
		for($i=0;$i<$cnt;$i++){
			if($i>$clen)
				$clres[]=$cl[$cnt-$i];
			else{
				$clres[]=$cl[$i];
			}
		}
        return $clres;
    }
}
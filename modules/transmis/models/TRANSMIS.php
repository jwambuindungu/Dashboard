<?php

namespace app\modules\transmis\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;

class TRANSMIS extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    // public static function tableName()
    // {
        // return 'P15_2680_94.DASH_TS_NTS';
    // }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('transmis_db');
    }

    /**
     * @param string $schema_name
     * @return mixed
     *
     * @deprecated
     */
	 
    
	
	
	public static function GET_REPAIRS_COSTS($range=[])
	{
	    $add = '';
	    if(!empty($range)){
            $add = "AND SPEC_DATE BETWEEN '".$range[0]."' AND '".$range[1]."'";
        }
		$db = self::getDb();
		$sql="SELECT TRANSMIS.REPAIR_SPECIFICATION.REPAIR_TYPE,SUM(TRANSMIS.REPAIR_SPECIFICATION.INVOICE_AMOUNT) AS REPAIR_AMOUNT FROM 
		TRANSMIS.REPAIR_SPECIFICATION WHERE TRANSMIS.REPAIR_SPECIFICATION.INVOICE_STATUS = 'PROCESSED' $add GROUP BY TRANSMIS.REPAIR_SPECIFICATION.REPAIR_TYPE";
		
		$model = $db->createCommand($sql);
		$data = $model->queryAll();
		
        return $data;
	}
	
	
	
	
	public static function GET_ANNUAL_REPAIRS_COSTS($yr='')
    {
		
        if(empty($yr)){
            $y = TRANSMIS::REPAIR_YEARLIST();
            $yr = $y[0]['yr'];
        }
		
		$db = self::getDb();
	
						
				

		/*$sql="SELECT EXTRACT(month FROM REPAIR_SPECIFICATION.SPEC_DATE) "Month", 
			SUM(TRANSMIS.REPAIR_SPECIFICATION.INVOICE_AMOUNT) "Invoice Amount",
				EXTRACT(YEAR FROM REPAIR_SPECIFICATION.SPEC_DATE) "Year"   
			FROM 
			TRANSMIS.REPAIR_SPECIFICATION WHERE EXTRACT(YEAR FROM TRANSMIS.REPAIR_SPECIFICATION.SPEC_DATE)='2015'  
			GROUP BY 
			EXTRACT(month FROM REPAIR_SPECIFICATION.SPEC_DATE),EXTRACT(YEAR FROM REPAIR_SPECIFICATION.SPEC_DATE)
				ORDER BY 
				"Month" ASC";
						*/
						
						
			/*$sql="SELECT EXTRACT(month FROM REPAIR_SPECIFICATION.SPEC_DATE)	AS MONTH, 
			SUM(TRANSMIS.REPAIR_SPECIFICATION.INVOICE_AMOUNT) AS INVOICE_AMOUNT
				  
			FROM 
			TRANSMIS.REPAIR_SPECIFICATION WHERE EXTRACT(YEAR FROM TRANSMIS.REPAIR_SPECIFICATION.SPEC_DATE)='2015'  
			GROUP BY 
			EXTRACT(month FROM REPAIR_SPECIFICATION.SPEC_DATE),EXTRACT(YEAR FROM REPAIR_SPECIFICATION.SPEC_DATE)
				ORDER BY 
				MONTH ASC";*/
				
				
				
				$sql="SELECT TO_CHAR(TO_DATE(EXTRACT(month FROM REPAIR_SPECIFICATION.SPEC_DATE),'mm'),'MONTH') AS MONTH, 
			SUM(TRANSMIS.REPAIR_SPECIFICATION.INVOICE_AMOUNT) AS INVOICE_AMOUNT
				  
			FROM 
			TRANSMIS.REPAIR_SPECIFICATION WHERE EXTRACT(YEAR FROM TRANSMIS.REPAIR_SPECIFICATION.SPEC_DATE)='$yr'  
			GROUP BY 
			EXTRACT(month FROM REPAIR_SPECIFICATION.SPEC_DATE),EXTRACT(YEAR FROM REPAIR_SPECIFICATION.SPEC_DATE)
				ORDER BY 
				EXTRACT(month FROM REPAIR_SPECIFICATION.SPEC_DATE) ASC";
						
			$model = $db->createCommand($sql);
		$data = $model->queryAll();
		
        return $data;
    }
	
	
		
	
	
	public static function REPAIR_YEARLIST()
    {
        $lYr = 2006;
        $currDay = date('j');
        $currMon = date('n');
        $currYr = date('Y');
        $yList = [];

        /*if($currMon > 6){
            $currYr++;
        }*/
        $tz=0;
        for($i=$currYr;$i>=$lYr;$i--){
            $yList[]=['yr'=>$i];
        }
        return $yList;
    }
}
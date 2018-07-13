<?php

namespace app\modules\website\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;


class WEBDATA extends ActiveRecord
{

    public static function COLLEGES($schema_name = 'DASHBOARD')
    {
        $columns = [
            'DISTINCT COLLEGE',
        ];

        $query = new Query();
        $query->select($columns)
            ->from("$schema_name.WEBOMETRIC_COLLEGE");

        $command = $query->createCommand(self::getDb());

        // die($command->rawSql);
        $data = $command->queryAll();
        return $data;
    }


    public static function DATES($schema_name = 'DASHBOARD')
    {
        $columns = [
            'DATE',
        ];

        $query = new Query();
        $query->select($columns)->distinct()
            ->from("$schema_name.WEBOMETRIC_COLLEGE")
            ->limit(2)
            ->orderBy(['DATE' => SORT_DESC]);

        $command = $query->createCommand(self::getDb());

//         die($command->rawSql);
        $data = $command->queryAll();
        return $data;
    }

    public static function WEBMETRICS($schema_name = 'DASHBOARD')
    {
        $dt = WEBDATA::DATES();
        $sql = 'SELECT * FROM (
            SELECT 
                DASHBOARD.WEBOMETRIC_COLLEGE.COLLEGE,
                DASHBOARD.WEBOMETRIC_COLLEGE.PRESENCE,
                DASHBOARD.WEBOMETRIC_COLLEGE.BACKLINKS,
                DASHBOARD.WEBOMETRIC_COLLEGE.DOMAINS,
                DASHBOARD.WEBOMETRIC_COLLEGE.CITATIONS,
                DASHBOARD.WEBOMETRIC_COLLEGE."DATE"
                FROM "DASHBOARD"."WEBOMETRIC_COLLEGE"
                WHERE "DATE" IN (\''.$dt[0]['DATE'].'\',\''.$dt[1]['DATE'].'\')
            )
            PIVOT(
                MAX(PRESENCE) PRESENCE,	MAX(BACKLINKS) BACKLINKS,MAX(DOMAINS) DOMAINS,MAX(CITATIONS) CITATIONS
                FOR "DATE"
                IN (\''.$dt[0]['DATE'].'\' CURR, \''.$dt[1]['DATE'].'\' PREV)
            )';
        $model = self::getDb()->createCommand($sql);
        $data = $model->queryAll();
        return $data;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 16-Jun-17
 * Time: 14:33
 */

namespace app\components;


class DATA_INTERVAL
{
    /**
     * @VAR CONST YEAR_INTERVAL NUMBER OF YEARS.
     */
    CONST YEAR_INTERVAL = 'Y';

    /**
     * @VAR CONST MONTH_INTERVAL NUMBER OF MONTHS.
     */
    CONST MONTH_INTERVAL = 'M';


    /**
     * @VAR CONST  DAY_INTERVAL NUMBER OF DAYS.
     */
    CONST DAY_INTERVAL = 'D';


    /**
     * @VAR CONST HOUR_INTERVAL HOUR_INTERVAL NUMBER OF HOURS.
     */
    CONST HOUR_INTERVAL = 'H';

    /**
     * @VAR CONST MINUTE_INTERVAL MINUTE_INTERVAL NUMBER OF MINUTES.
     */
    CONST MINUTE_INTERVAL = 'I';

    /**
     * @VAR CONST SECOND NUMBER OF SECONDS.
     */
    CONST SECOND_INTERVAL = 'S';


    /**
     * @VAR CONST MICROSECOND_INTERVAL NUMBER OF MICROSECONDS, AS A FRACTION OF A SECOND.
     */
    CONST MICROSECOND_INTERVAL = 'F';

    /**
     * @var string DATE_FORMAT Date format
     */
    public static $FINISH_DATE = null;
    public static $DATE_FORMAT = 'Y-m-d';

    /**
     * Compute the duration of a data range based on date intervals
     * @param $duration
     * @param $duration_name
     * @return string
     */
    public static function COMPUTE_DATA_DATE_RANGE($duration = 0, $duration_name = self::DAY_INTERVAL)
    {
        if (self::$FINISH_DATE == null) {
            self::$FINISH_DATE = date(DATA_INTERVAL::$DATE_FORMAT);
        } else {
            $date = new \DateTime(self::$FINISH_DATE);
            self::$FINISH_DATE = $date->format(self::$DATE_FORMAT);
        }

        $D = intval($duration);
        $DC = strtoupper($duration_name);

        if ($duration < 0) {
            $D = intval($duration) * -1;
            $interval = new \DateInterval('P' . $D . $DC);
            $interval->invert = 1;
        } else {
            $interval = new \DateInterval('P' . $D . $DC);
        }


        //$finishDate = date(self::$FINISH_DATE);
        $date = new \DateTime(self::$FINISH_DATE);
        $date->add($interval); //M Y W D
        $duration_date = $date->format(self::$DATE_FORMAT);
        return $duration_date;
    }

    public static function COMPUTE_DATE_RANGE($duration, $duration_name)
    {
        $data_range = [
            'START_DATE' => self::COMPUTE_DATA_DATE_RANGE($duration, $duration_name),
            'END_DATE' => self::$FINISH_DATE
        ];

        return (object)$data_range;
    }

}
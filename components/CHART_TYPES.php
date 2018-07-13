<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 13-Jun-17
 * Time: 12:54
 */

namespace app\components;


class CHART_TYPES
{
    /**
     * @var string the type of chart to display. The possible options are:
     * - "Line" : A line chart is a way of plotting data points on a line. Often, it is used to show trend data, and the
     * comparison of two data sets.
     * - "Bar" : A bar chart is a way of showing data as bars. It is sometimes used to show trend data, and the
     * comparison of multiple data sets side by side.
     * - "Radar" : A radar chart is a way of showing multiple data points and the variation between them. They are often
     * useful for comparing the points of two or more different data sets
     * - "PolarArea" : Polar area charts are similar to pie charts, but each segment has the same angle - the radius of
     * the segment differs depending on the value. This type of chart is often useful when we want to show a comparison
     * data similar to a pie chart, but also show a scale of values for context.
     * - "Pie" : Pie charts are probably the most commonly used chart there are. They are divided into segments, the arc
     * of each segment shows a the proportional value of each piece of data.
     * - "Doughnut" : Doughnut charts are similar to pie charts, however they have the centre cut out, and are therefore
     * shaped more like a doughnut than a pie!
     */
    const LINE = 'line';
    const BAR = 'Bar';
    const RADAR = 'Radar';
    const POLAR_AREA = 'PolarArea';
    const PIE_CHART = 'Pie';
    const DOUGHNUT = 'Doughnut';
}
<?php
/**
 * @package   yii2-chartjs-widget
 * @author    Miro Hudak <mhudak@dev.enscope.com>
 * @copyright Copyright &copy; Miro Hudak, enscope.com, 2016
 * @version   1.0
 */

namespace enscope\Yii2ChartJs
{
    use yii\web\AssetBundle;

    class ChartJsAsset
        extends AssetBundle
    {
        public $sourcePath = '@bower/chartjs/dist';

        public function init()
        {
            $this->js = YII_DEBUG
                ? ['Chart.js']
                : ['Chart.min.js'];
        }
    }
}

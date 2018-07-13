<?php
/**
 * @package   yii2-chartjs-widget
 * @author    Miro Hudak <mhudak@dev.enscope.com>
 * @copyright Copyright &copy; Miro Hudak, enscope.com, 2016
 * @version   1.0
 */

namespace enscope\Yii2ChartJs
{
    use yii\base\InvalidConfigException;
    use yii\base\Widget;
    use yii\helpers\Html;
    use yii\helpers\Json;
    use yii\web\JsExpression;

    class ChartJsWidget
        extends Widget
    {
        const CHART_LINE = 'line';
        const CHART_BAR = 'bar';
        const CHART_RADAR = 'radar';
        const CHART_POLAR_AREA = 'polarArea';
        const CHART_PIE = 'pie';
        const CHART_DOUGHNUT = 'doughnut';

        /** @var bool Flags, if global options were already set */
        public static $globalOptionsSet = false;
        /** @var array Array of global options, which will be set on first output (not yet implemented!) */
        public static $globalOptions = [];

        /** @var null|string Identifier of the chart canvas (null to autogenerate) */
        public $id = null;
        /** @var array Chart canvas options (HTML attributes as KVPs) */
        public $canvasOptions = [];
        /** @var null|string Type of the chart (see CHART_ constants) */
        public $chartType = null;
        /** @var array Chart data, specific for the chart type */
        public $chartData = [];
        /** @var array Chart options, specific for the chart type */
        public $chartOptions = [];

        /**
         * Initializes the object.
         * This method is invoked at the end of the constructor after the object is initialized with the
         * given configuration.
         */
        public function init()
        {
            parent::init();

            // if identifier is not specified, autogenerate one
            $this->id = $this->id ?: $this->getId();
            $this->canvasOptions['id'] = $this->id;

            if (!$this->chartType)
            {
                // if chart type is not specified, issue an error
                throw new InvalidConfigException('Chart type must be specified. See CHART_* constants or documentation.');
            }
        }

        /**
         * Executes the widget.
         *
         * @return string the result of widget execution to be outputted.
         */
        public function run()
        {
            echo Html::tag('canvas', '', $this->canvasOptions);
            $this->registerJs();
        }

        protected function registerJs()
        {
            $view = $this->getView();
            ChartJsAsset::register($view);
            $instanceName = "__esc_chartJs_{$this->id}";
            $jsonConfig = Json::encode($this->createChartConfig());
            $jsSrc = "var {$instanceName} = new Chart($('#{$this->id}'), {$jsonConfig});";
            $view->registerJs($jsSrc);
        }

        protected function createChartConfig()
        {
            return [
                'type' => $this->chartType,
                'data' => $this->chartData,
                'options' => $this->chartOptions,
            ];
        }

        public static function js($jsExpression)
        {
            return new JsExpression($jsExpression);
        }
    }
}

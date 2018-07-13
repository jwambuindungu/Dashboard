<?php

namespace app\modules\rgmis;

/**
 * student module definition class
 */
class rgmis extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\rgmis\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        // custom initialization code:
       \Yii::$app->view->theme->pathMap = ['@app/views' => '@app/themes/adminlte/views'];
       \Yii::$app->view->theme->baseUrl = '@web/themes/adminlte';
    }
}

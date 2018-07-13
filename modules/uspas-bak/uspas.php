<?php

namespace app\modules\uspas;

/**
 * student module definition class
 */
class uspas extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\uspas\controllers';

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

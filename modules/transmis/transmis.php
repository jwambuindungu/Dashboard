<?php

namespace app\modules\transmis;

/**
 * student module definition class
 */
class transmis extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\transmis\controllers';

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

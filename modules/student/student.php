<?php

namespace app\modules\student;

/**
 * student module definition class
 */
class student extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\student\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        // custom initialization code:
       // \Yii::$app->view->theme->pathMap = ['@app/views' => '@app/themes/sbadmin/views'];
       // \Yii::$app->view->theme->baseUrl = '@web/themes/sbadmin';
    }
}

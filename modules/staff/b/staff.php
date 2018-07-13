<?php

namespace app\modules\staff;

/**
 * student module definition class
 */
class staff extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\staff\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        // // custom initialization code: AdminLTE
        \Yii::$app->view->theme->pathMap = ['@app/views' => '@app/themes/adminlte/views'];
        \Yii::$app->view->theme->baseUrl = '@web/themes/adminlte';
		
        // custom initialization code: SBAdmin
        // \Yii::$app->view->theme->pathMap = ['@app/views' => '@app/themes/sbadmin/views'];
        // \Yii::$app->view->theme->baseUrl = '@web/themes/sbadmin';
    }
}

<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use app\components\AController;
/**
 * Default controller for the `admin` module
 */
class DefaultController extends AController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}

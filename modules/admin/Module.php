<?php

namespace app\modules\admin;
use Yii;
use app\models\Users;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        
        $this->layout = '@app/modules/admin/views/layouts/main';

        // custom initialization code goes here
    }
    
    public function beforeAction($action) {
        if (Yii::$app->user->isGuest) {
            Yii::$app->getResponse()->redirect(Yii::$app->urlManager->createUrl('/site/login'));
        }else {
            $user = Users::findOne(Yii::$app->user->id);
//            if($user->type == 1) {
//                Yii::$app->getResponse()->redirect(Yii::$app->urlManager->createUrl('/admin'));
//            }
            return parent::beforeAction($action);
        }
//        return parent::beforeAction($action);
    }
}

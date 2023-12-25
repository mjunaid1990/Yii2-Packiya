<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components;

use Yii;
use app\models\Users;
use yii\web\BadRequestHttpException;

class AController extends \yii\web\Controller {

    public function init() {
        parent::init();
    }

//    public function beforeAction($action) {
//        if (Yii::$app->user->isGuest) {
//            Yii::$app->getResponse()->redirect(Yii::$app->urlManager->createUrl('/site/login'));
//        } else {
//            $user = Users::findOne(Yii::$app->user->id);
//            if ($user->type == 1) {
//                Yii::$app->getResponse()->redirect(Yii::$app->urlManager->createUrl('/admin'));
//            }
//            return parent::beforeAction($action);
//        }
//        return parent::beforeAction($action);
//    }

//    public function beforeAction($action) {
//        if (parent::beforeAction($action)) {
//            if (Yii::$app->user->isGuest) {
//                throw new BadRequestHttpException(Yii::t('app', 'Your are not allowed'));
//            }
//            return true;
//        }
//        return false;
//    }

}

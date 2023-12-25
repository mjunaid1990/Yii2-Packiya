<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components;

use Yii;

/**
 * Extended yii\web\User
 *
 * This allows us to do "Yii::$app->user->something" by adding getters
 * like "public function getSomething()"
 *
 * So we can use variables and functions directly in `Yii::$app->user`
 */
class User extends \yii\web\User
{
    public function getUsername()
    {
        return \Yii::$app->user->identity->username;
    }

    public function getName()
    {
        return \Yii::$app->user->identity->name;
    }
    
    public function getProfilePic() {
        if($this->image) {
            return Yii::$app->request->baseUrl.'/uploads/'.$this->image;
        }else {
            return Yii::$app->urlManager->baseUrl.'/default.png';
        }
    }
}
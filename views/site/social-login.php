<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

$this->title = 'Join Free';
?>
<style>
    .auth-clients li {
        margin-top: 10px;
    }
    ul.auth-clients li {
        float: unset;
        border: unset;
    }
</style>
<div id="regopage">

    <?php
    $form = ActiveForm::begin([
                'id' => 'register-form',
    ]);
    ?>
    <div class="registrationPage">


        <div class="registrationForm" id="registration1">
            <ul>
                <li id="registration1Heading" style="text-align:center" class="upper-case">
                    It's <span class="upper-case highlightAB"><?php echo Yii::t('app', 'Free') ?></span> <?php echo Yii::t('app', 'To Join') ?>
                </li>
            </ul>

            <div class="horizontalLine">
                <span class="orText upper-case"><?php echo Yii::t('app', 'or') ?></span>
            </div>

            <ul>
                <li class="clearfix">
                    <label id="registration1label"><?php echo Yii::t('app', 'First Name') ?></label>
                    <span id="firstName_r_validate"> 
                        <?= $form->field($model, 'first_name')->textInput(['id' => 'firstName_r'])->label(false); ?>
                    </span>
                </li>
                <li class="clearfix">
                    <label id="registration1label"><?php echo Yii::t('app', 'Password') ?></label>
                    <span id="pword_r_validate" class="textfieldValidState"> 
                        <?= $form->field($model, 'password')->passwordInput(['id' => 'pword_r'])->label(false); ?>                               
                    </span>
                </li>
                <li class="clearfix">
                    <label id="registration1label"><?php echo Yii::t('app', 'Email') ?></label>
                    <span id="email_r_validate" class="textfieldValidState"> 
                        <?= $form->field($model, 'email')->textInput(['id' => 'email_r'])->label(false); ?>  
                    </span>
                </li>
                <li class="clearfix">
                    <label id="registration1label"><?php echo Yii::t('app', 'I\'m a') ?></label>
                    <span id="gender_validate"> 
                        <?= $form->field($model, 'gender')->inline(true)->radioList([2 => 'Male', 3 => 'Female'])->label(false); ?> 
                        <div class="formclear"></div>
                    </span>
                </li>
                <li class="clearfix">
                    <span id="age_validate">
                        <label id="registration1label"><?php echo Yii::t('app', 'Age') ?></label>
                        <?= $form->field($model, 'age')->dropDownList(\app\models\Users::Age(), ['prompt' => '', 'id' => 'age'])->label(false); ?>
                        <div class="formclear"></div>
                    </span>
                </li>
                <li class="clearfix">
                    <label id="registration1label"><?php echo Yii::t('app', 'Country') ?></label>
                    <span id="r_country_validate"> 
                        <?= $form->field($model, 'country_id')->dropDownList(ArrayHelper::map(\app\models\Countries::find()->all(), 'id', 'name'), ['prompt' => '-Select a Country', 'id' => 'r_country',
                            'onchange' => '$.post( "' . Yii::$app->urlManager->createUrl('/site/state-lists?id=') . '"+$(this).val(), function( data ) {
                                                     $( "select#users-state_id" ).html( data );
                                                   });
                                           '])->label(false);
                        ?>
                    </span>
                </li>

                <li class="clearfix">
                    <label id="registration1label"><?php echo Yii::t('app', 'State/Province') ?></label>
                    <span id="r_state_validate">
                        <?php
                        $states = [];
                        ?>
                        <?= $form->field($model, 'state_id')->dropDownList($states,['prompt' => '-Select a State-',
                                    'onchange' => '$.post( "' . Yii::$app->urlManager->createUrl('/site/cities-lists?id=') . '"+$(this).val(), function( data ) {
                                                     $( "select#r_city" ).html( data );
                                                   });
                                           '])->label(false);
                        ?>
                    </span>
                </li>
                <li class="clearfix">
                    <label id="registration1label"><?php echo Yii::t('app', 'City') ?></label>
                    <span id="r_city_validate"> 
                        <?php
                        $cities = [];
                        ?>
                        <?= $form->field($model, 'city_id')->dropDownList($cities,['prompt' => '-Select a City', 'id' => 'r_city'])->label(false); ?>
                    </span>
                    <div id="ErrorHandling"></div>
                </li>

                <li style="border:0">
                    <div id="loginButton" class="loginbutton">
                        <?= Html::submitButton(Yii::t('app', 'View Singles Now'), ['class' => 'btn btn-orange upper-case', 'name' => 'login-button']) ?>
                    </div>
                </li>

                <li style="border:0;text-align:center">
                    <span id="terms_validate"> 
<?= $form->field($model, 'terms_and_conditions')->checkbox(['label' => '<span>' . Yii::t('app', 'Yes, I Agree to the') . '</span> <a href="' . Yii::$app->urlManager->createUrl('/page/terms-and-conditions') . '" target="_blank">' . Yii::t('app', 'Terms of Use') . '</a> and <a href=""' . Yii::$app->urlManager->createUrl('/page/privacy-statements') . '"" target="blank">Privacy Statement</a>', 'checked' => '', 'id' => 'terms_1']) ?>
                        <div class="formclear"></div>
                    </span>
                </li>

            </ul>                                                                                    
        </div>



        <div style="height:500px" class="right">
            
        </div>
        <div class="clear"></div></div>
<?php ActiveForm::end(); ?>
</div>
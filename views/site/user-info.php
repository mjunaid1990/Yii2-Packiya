<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Packiya Poral - Payment';
$this->params['breadcrumbs'][] = $this->title;

$curr = [
    'USD'=>'Unites State (USD)',
    'SGD'=>'Singapore (SGD)',
    'AUD'=>'Australia (AUD)',
    'GBP'=>'UK (GBP)',
    'EUR'=>'Europe (EUR)',
    'AED'=>'UAE (AED)'
]

?>
<div class="site-login">


    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

    <?= $form->field($model, 'firstname')->textInput(['autofocus' => true]) ?>
    
    <?= $form->field($model, 'lastname')->textInput() ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'amount')->textInput(['type' => 'number', 'step'=>'any']) ?>
    
    <?= $form->field($model, 'currency')->dropDownList($curr,['prompt'=>'Select ...']) ?>

    <?= $form->field($model, 'qty')->textInput(['type' => 'number', 'min'=>0]) ?>
    
    <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>


    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

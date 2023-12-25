<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box">
    <div class="box-header">
        <h4><?= Html::encode($this->title) ?></h4>
    </div>
    <div class="box-body">
        <div class="user-update">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'readonly'=>true]) ?>

    <?= $form->field($model, 'new_password')->passwordInput(['maxlength' => true]) ?>
    <span>Leave it blank if you do not want to change password</span>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
    </div>
</div>

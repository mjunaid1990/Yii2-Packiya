<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ProductImages $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-images-form">
    <div class="box box-default">
        <div class="box-body">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'product_id')->hiddenInput()->label(false) ?>

            <?= $form->field($model, 'order_no')->textInput(['type' => 'number']) ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

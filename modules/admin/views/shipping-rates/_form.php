<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\BoxesTypes;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\ShippingRates $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="shipping-rates-form">
    <div class="box box-default">
        <div class="box-body">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'box_id')->dropDownList(ArrayHelper::map(BoxesTypes::find()->asArray()->all(), 'id', 'name'), ['propmpt' => 'select']) ?>

            <?= $form->field($model, 'rate')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

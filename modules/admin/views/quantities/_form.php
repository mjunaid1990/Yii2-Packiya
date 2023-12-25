<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\BoxesTypes;
/** @var yii\web\View $this */
/** @var app\models\Quantities $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="quantities-form">
    <div class="box box-default">
        <div class="box-body">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'box_id')->dropDownList(ArrayHelper::map(BoxesTypes::find()->asArray()->all(), 'id', 'name'), ['prompt' => 'select']) ?>

            <?= $form->field($model, 'box_sub_type')->dropDownList([1 => 'CardStock', 2 => 'Corrugated'], ['prompt' => 'Select...']) ?>
            
            <?= $form->field($model, 'option_name')->textInput(['type'=>'number']) ?>

            <?= $form->field($model, 'option_discount')->textInput(['type'=>'number', 'step'=>'any']) ?>
            
            <?= $form->field($model, 'each_price')->textInput(['type'=>'number', 'step'=>'any']) ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

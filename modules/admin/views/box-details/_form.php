<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\BoxesTypes;
use app\models\PaperMeterial;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\BoxDetails $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="box box-default">
    <div class="box-body">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'box_type')->dropDownList(ArrayHelper::map(BoxesTypes::find()->asArray()->all(), 'id', 'name'), ['propmpt' => 'select']) ?>

        <?= $form->field($model, 'box_sub_type')->dropDownList([1 => 'CardStock', 2 => 'Corrugated'], ['prompt' => 'Select...']) ?>

        <?= $form->field($model, 'box_paper_size')->dropDownList(ArrayHelper::map(PaperMeterial::find()->asArray()->all(), 'id', 'name'), ['propmpt' => 'select']) ?>

        <?= $form->field($model, 'per_paper_price')->textInput(['type' => 'number', 'step' => 'any']) ?>
        
        <?= $form->field($model, 'box_width')->textInput(['type' => 'number', 'step' => 'any']) ?>

        <?= $form->field($model, 'box_height')->textInput(['type' => 'number', 'step' => 'any']) ?>
        
        <?= $form->field($model, 'paper_gsm')->textInput(['type' => 'number', 'step' => 'any']) ?>

        <?= $form->field($model, 'waste_sheets')->textInput(['type' => 'number', 'step' => 'any']) ?>

        <?= $form->field($model, 'packing_rate')->textInput(['type' => 'number', 'step' => 'any']) ?>

        <?= $form->field($model, 'plating_rate')->textInput(['type' => 'number', 'step' => 'any']) ?>

        <?= $form->field($model, 'die_cutting_rate')->textInput(['type' => 'number', 'step' => 'any']) ?>

        <?= $form->field($model, 'side_pasting_rate')->textInput(['type' => 'number', 'step' => 'any']) ?>

        <?= $form->field($model, 'glossy_aqueous_coating')->textInput(['type' => 'number', 'step' => 'any']) ?>

        <?= $form->field($model, 'high_gloss_aqueous_coating')->textInput(['type' => 'number', 'step' => 'any']) ?>

        <?= $form->field($model, 'matte_aqueous_coating')->textInput(['type' => 'number', 'step' => 'any']) ?>

        <?= $form->field($model, 'soft_touch_laminate')->textInput(['type' => 'number', 'step' => 'any']) ?>

        <?= $form->field($model, 'no_printing')->textInput(['type' => 'number', 'step' => 'any']) ?>

        <?= $form->field($model, 'inside_priting')->textInput(['type' => 'number', 'step' => 'any']) ?>

        <?= $form->field($model, 'outside_printing')->textInput(['type' => 'number', 'step' => 'any']) ?>

        <?= $form->field($model, 'both_side_printing')->textInput(['type' => 'number', 'step' => 'any']) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\BoxesTypes;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\PaperMeterial $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="paper-meterial-form">
    <div class="box box-default">
        <div class="box-body">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'box_type')->dropDownList(ArrayHelper::map(BoxesTypes::find()->asArray()->all(), 'id', 'name'), ['propmpt' => 'select']) ?>

            <?= $form->field($model, 'box_sub_type')->dropDownList([1 => 'CardStock', 2 => 'Corrugated'], ['prompt' => 'Select...']) ?>
            
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'rate')->textInput(['type' => 'number', 'step'=>'any']) ?>


            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

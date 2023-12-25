<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\BoxesTypes;
use yii\helpers\ArrayHelper;
/** @var yii\web\View $this */
/** @var app\models\Faqs $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="faqs-form">
    <div class="box box-default">
        <div class="box-body">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'box_id')->dropDownList(ArrayHelper::map(BoxesTypes::find()->asArray()->all(), 'id', 'name'), ['prompt' => 'select']) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

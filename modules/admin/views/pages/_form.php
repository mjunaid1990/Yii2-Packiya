<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
/** @var yii\web\View $this */
/** @var app\models\Pages $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pages-form">
    <div class="box box-default">
        <div class="box-body">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'content')->widget(CKEditor::className(), [
                'options' => ['rows' => 6],
                'preset' => 'basic',
                'clientOptions' => [
                    'entities_additional' => '', // Disable HTML entities encoding
                    // ... other CKEditor options
                ],
            ]) ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

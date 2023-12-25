<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\ProductMainCategories;
use floor12\summernote\Summernote;
/** @var yii\web\View $this */
/** @var app\models\ProductChildCategories $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-child-categories-form">
    <div class="box box-default">
        <div class="box-body">
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

            <?= $form->field($model, 'product_main_cat_id')->dropDownList(ArrayHelper::map(ProductMainCategories::find()->asArray()->all(), 'id', 'name'), ['propmpt' => 'select']) ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'description')->widget(Summernote::className()) ?>

            <?= $form->field($model, 'image')->fileInput() ?>
            
            <?php
            if($model->image) {
                ?>
                <div class="form-group">
                    <img src="<?= $model->getImageurl() ?>" class="img-responsive" alt="" style="height: 100px" />
                </div>
                <?php
            }
            ?>
            
            <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'meta_keyword')->textarea(['rows' => 4]) ?>
            <?= $form->field($model, 'meta_description')->textarea(['rows' => 4]) ?>
            

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

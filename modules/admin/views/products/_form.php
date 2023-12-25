<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\BoxesTypes;
use dosamigos\ckeditor\CKEditor;
use floor12\summernote\Summernote;
use app\models\ProductChildCategories;
/** @var yii\web\View $this */
/** @var app\models\Products $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="products-form">
    <div class="box box-default">
        <div class="box-body">
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

            <?= $form->field($model, 'box_type')->dropDownList(ArrayHelper::map(BoxesTypes::find()->asArray()->all(), 'id', 'name'), ['prompt' => 'select']) ?>
            
            <?= $form->field($model, 'child_category_id')->dropDownList(ArrayHelper::map(ProductChildCategories::find()->asArray()->all(), 'id', 'name'), ['prompt' => 'select']) ?>

            <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'product_display_name')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'short_desc')->textarea(['rows' => 4]) ?>
            
            <h3>Image Gallery</h3>

            <button type="button" class="btn btn-primary btn-sm" id="add-input">Add Image</button>
            
            <br />
            <br />
            <div id="input-container"></div>
            <br />
            
            <?php 
            if($model->id) {

                $gallery = $model->getGallery();
                if($gallery) {
                    foreach ($gallery as $key=>$gal) {
                        ?>
                        <div class="img-thumbnail">
                            <img src="<?= $gal ?>" alt="" class="img-responsive" style="height: 80px" />
                            <a href="/admin/products/delete-gallery?id=<?= $key ?>" class="btn btn-danger">
                                <i class="fa fa-remove"></i>
                            </a>
                        </div>
                        <?php
                    }
                }
                echo '<br />';
            } 
            ?>
            <br />
            
            <?= $form->field($model, 'description')->widget(Summernote::className()) ?>
            
            

            <?= $form->field($model, 'description_image')->fileInput() ?>
            
            <?php
            if($model->description_image) {
                ?>
                <div class="form-group">
                    <img src="<?= $model->getImageurl('description_image') ?>" class="img-responsive" alt="" style="height: 100px" />
                </div>
                <?php
            }
            ?>

            <?= $form->field($model, 'overview')->widget(Summernote::className()) ?>

            <?= $form->field($model, 'overview_image')->fileInput() ?>
            
            <?php
            if($model->overview_image) {
                ?>
                <div class="form-group">
                    <img src="<?= $model->getImageurl('overview_image') ?>" class="img-responsive" alt="" style="height: 100px" />
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


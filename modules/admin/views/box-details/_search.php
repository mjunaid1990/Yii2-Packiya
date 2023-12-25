<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\BoxDetailsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="box-details-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'box_type') ?>

    <?= $form->field($model, 'box_sub_type') ?>

    <?= $form->field($model, 'box_paper_size') ?>

    <?php // echo $form->field($model, 'box_width') ?>

    <?php // echo $form->field($model, 'box_height') ?>

    <?php // echo $form->field($model, 'waste_sheets') ?>

    <?php // echo $form->field($model, 'packing_rate') ?>

    <?php // echo $form->field($model, 'plating_rate') ?>

    <?php // echo $form->field($model, 'die_cutting_rate') ?>

    <?php // echo $form->field($model, 'side_pasting_rate') ?>

    <?php // echo $form->field($model, 'glossy_aqueous_coating') ?>

    <?php // echo $form->field($model, 'high_gloss_aqueous_coating') ?>

    <?php // echo $form->field($model, 'matte_aqueous_coating') ?>

    <?php // echo $form->field($model, 'soft_touch_laminate') ?>

    <?php // echo $form->field($model, 'no_printing') ?>

    <?php // echo $form->field($model, 'inside_priting') ?>

    <?php // echo $form->field($model, 'outside_printing') ?>

    <?php // echo $form->field($model, 'both_side_printing') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

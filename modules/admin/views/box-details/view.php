<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\BoxDetails $model */
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Box Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="box-details-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>
    <div class="box box-default">
        <div class="box-body">
            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'name',
                    'box_type',
                    'box_sub_type',
                    'box_paper_size',
                    'box_width',
                    'box_height',
                    'waste_sheets',
                    'packing_rate',
                    'plating_rate',
                    'die_cutting_rate',
                    'side_pasting_rate',
                    'glossy_aqueous_coating',
                    'high_gloss_aqueous_coating',
                    'matte_aqueous_coating',
                    'soft_touch_laminate',
                    'no_printing',
                    'inside_priting',
                    'outside_printing',
                    'both_side_printing',
                ],
            ])
            ?>
        </div>
    </div>
</div>

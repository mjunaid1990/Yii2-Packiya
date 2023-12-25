<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\ProductChildCategories $model */
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Product Child Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-child-categories-view">

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
                    'product_main_cat_id',
                    'name',
                    'image',
                ],
            ])
            ?>
        </div>
    </div>
</div>

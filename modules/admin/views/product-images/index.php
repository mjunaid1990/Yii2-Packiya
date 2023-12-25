<?php

use app\models\ProductImages;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Products;

/** @var yii\web\View $this */
/** @var app\models\ProductImagesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$this->title = 'Product Images';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-images-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>
    <div class="box box-default">
        <div class="box-body">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    [
                        'header' => 'Product',
                        'attribute' => 'product_id',
                        'format' => 'raw',
                        'value'=>function($model) {
                            $product = Products::findOne($model->product_id);
                            if($product) {
                                return $product->product_name;
                            }
                            return 'N/A';
                        }
                    ],
                    'image',
                    'order_no',
                    [
                        'class' => ActionColumn::className(),
                        'template'=> '{update}',
                        'urlCreator' => function ($action, ProductImages $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]);
            ?>

        </div>
    </div>
</div>

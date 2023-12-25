<?php

use app\models\ShippingRates;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\BoxesTypes;

/** @var yii\web\View $this */
/** @var app\models\ShippingRatesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$this->title = 'Shipping Rates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shipping-rates-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Shipping Rates', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
                        'header' => 'Box Type',
                        'attribute' => 'box_id',
                        'format' => 'raw',
                        'value'=>function($model) {
                            $product = BoxesTypes::findOne($model->box_id);
                            if($product) {
                                return $product->name;
                            }
                            return 'N/A';
                        }
                    ],
                    'name',
                    'rate',
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, ShippingRates $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]);
            ?>

        </div>
    </div>
</div>

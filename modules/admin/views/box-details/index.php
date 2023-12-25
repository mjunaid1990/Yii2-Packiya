<?php

use app\models\BoxDetails;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\BoxDetailsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Box Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-details-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Box Details', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="box box-default">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'name',
                    'box_type',
                    'box_sub_type',
                    'box_paper_size',
                    //'box_width',
                    //'box_height',
                    //'waste_sheets',
                    //'packing_rate',
                    //'plating_rate',
                    //'die_cutting_rate',
                    //'side_pasting_rate',
                    //'glossy_aqueous_coating',
                    //'high_gloss_aqueous_coating',
                    //'matte_aqueous_coating',
                    //'soft_touch_laminate',
                    //'no_printing',
                    //'inside_priting',
                    //'outside_printing',
                    //'both_side_printing',
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, BoxDetails $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                         }
                    ],
                ],
            ]); ?>
        </div>
    </div>
    
    


</div>

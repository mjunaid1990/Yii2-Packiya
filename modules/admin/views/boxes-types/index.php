<?php

use app\models\BoxesTypes;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\BoxesTypesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$this->title = 'Boxes Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="boxes-types-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Boxes Types', ['create'], ['class' => 'btn btn-success']) ?>
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
                    'name',
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, BoxesTypes $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]);
            ?>
        </div>
    </div>

</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-default">
    <div class="box-header">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>

        <div class="box-tools pull-right">
            
        </div>
    </div>
    <div class="box-body">

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
//            'filterModel' => $searchModel,
            'columns' => [
//                ['class' => 'yii\grid\SerialColumn'],
//                'id',
                'email:email',
                'first_name',
                [
                    'attribute'=>'gender',
                    'value'=>function($model) {
                        return $model->getGender();
                    }
                ],
//                'phone',
                [
                    'header'=>'Address',
                    'value'=>function($model) {
                        return $model->getminiAddress();
                    }
                ],
                //'profile_create_by',
                //'date_created',
                //'date_updated',
                //'terms_and_conditions',
                [
                    'attribute' => 'image',
                    'format' => 'html',    
                    'value' => function ($data) {
                        return Html::img($data->profilePic,
                            ['width' => '70px']);
                    },
                ],
                //'type',
                [
                    'attribute'=>'status',
                    'value'=>function($model) {
                        return $model->getUserStatus();
                    }
                ],
//                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>
    </div>
</div>

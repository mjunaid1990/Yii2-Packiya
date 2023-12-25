<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\BoxDetails $model */

$this->title = 'Create Box Details';
$this->params['breadcrumbs'][] = ['label' => 'Box Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-details-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

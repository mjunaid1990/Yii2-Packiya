<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Quantities $model */

$this->title = 'Create Quantities';
$this->params['breadcrumbs'][] = ['label' => 'Quantities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quantities-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

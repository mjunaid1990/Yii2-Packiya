<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\BoxesTypes $model */

$this->title = 'Create Boxes Types';
$this->params['breadcrumbs'][] = ['label' => 'Boxes Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="boxes-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

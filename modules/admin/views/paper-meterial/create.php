<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PaperMeterial $model */

$this->title = 'Create Paper Meterial';
$this->params['breadcrumbs'][] = ['label' => 'Paper Meterials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paper-meterial-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

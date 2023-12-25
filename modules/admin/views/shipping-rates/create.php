<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ShippingRates $model */

$this->title = 'Create Shipping Rates';
$this->params['breadcrumbs'][] = ['label' => 'Shipping Rates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shipping-rates-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

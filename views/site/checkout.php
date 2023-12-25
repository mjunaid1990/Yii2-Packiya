<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Packiya Poral - Payment';
$this->params['breadcrumbs'][] = $this->title;
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" />
<style>
    body {
        margin: 0;
    }
    .login-box {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }
    .login-box .card {
        width: 400px;
        max-width: 100%;
    }
</style>

<div class="login-box">



    <div class="login-logo mb-4">
        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAQQAAABgCAYAAAD7GgzyAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMTQ1IDc5LjE2MzQ5OSwgMjAxOC8wOC8xMy0xNjo0MDoyMiAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTkgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjRGMUQ4RjY4NTlFMjExRUVBN0RCOENENEY4RTg2RDBFIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjRGMUQ4RjY5NTlFMjExRUVBN0RCOENENEY4RTg2RDBFIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6NEYxRDhGNjY1OUUyMTFFRUE3REI4Q0Q0RjhFODZEMEUiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6NEYxRDhGNjc1OUUyMTFFRUE3REI4Q0Q0RjhFODZEMEUiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz5gEQVoAAAawElEQVR42uxd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" alt="" style="width: 140px;" />
    </div>
    <br />
    <!-- /.login-logo -->

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg mb-2 text-center">Pay Now : <span style="font-size: 20px;"><?= '(' . $model->currency . ') ' . $model->amount; ?></span></p>
            <p><small><?= $model->message; ?></small></p>
            <p><small><?= 'Qty: ' . $model->qty; ?></small></p>


            <?php $form = ActiveForm::begin(['id' => 'payment-form']); ?>
            

            <div class="form-rows my-3">
                <div id="card-element">
                    <!-- A Stripe Element will be inserted here. -->
                </div>

                <!-- Used to display Element errors. -->
                <div id="card-errors" role="alert"></div>
            </div>

            <div class="form-group">
                <button id="pbtn" class="btn btn-success w-100">Pay Now</button>
            </div>

            <?php ActiveForm::end(); ?>




        </div>
        <!-- /.login-card-body -->
    </div>
</div>


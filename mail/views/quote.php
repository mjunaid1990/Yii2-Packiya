<?php
use yii\helpers\Html;
/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    
     <?php
     if($model) {
         ?>
        <p>Product Name: <?= $model->product_name; ?></p> 
        <p>Box Length: <?= $model->box_length; ?></p> 
        <p>Box Width: <?= $model->box_width; ?></p> 
        <p>Box Depth: <?= $model->box_depth; ?></p> 
        <p>Unit: <?= $model->unit; ?></p> 
        <p>Color: <?= $model->color; ?></p> 
        <p>Qty1: <?= $model->qty1; ?></p> 
        <p>Qty2: <?= $model->qty2; ?></p> 
        <p>Qty3: <?= $model->qty3; ?></p> 
        <p>Card Stock: <?= $model->box_paper_size; ?></p> 
        <p>Lamination: <?= $model->lamination; ?></p> 
        <p>Coating: <?= $model->coating; ?></p> 
        <p>Name: <?= $model->name; ?></p> 
        <p>Email: <?= $model->email; ?></p> 
        <p>Phone: <?= $model->phone; ?></p> 
        <p>Message: <?= $model->message; ?></p> 
        
        <?php
     }
     ?>   
    
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>




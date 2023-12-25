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
        if ($model) {
            ?>
            <p>Hi <?= $model->firstname; ?>,</p>
            <br />
            
            <p><strong>Description</strong>: <?= $model->message?$model->message:''; ?></p>
        
            <p>You have successfully made payment of $<?= $model->amount; ?> to Packiya. Thanks. </p>

            <?php
        }
        ?>   

<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>




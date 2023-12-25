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
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="95%">
    <tr>
        <td align="center">
            <table align="center" border="1" cellpadding="0" cellspacing="0" width="600"
                   style="border-collapse: separate; border-color: #fff; background: transparent; border:0;"
                   bgcolor="#fff">
                <tr style="background-color: #b8d9de; border-color: #fff;">
                    <td align="center" style="padding: 5px 5px 5px 5px; border-color: #fff; border: 0;">
                        <a href="https://www.nikaah.com.pk/" target="_blank">
                            <img src="https://i.ibb.co/3rvDpVy/mail-logo.png'; ?>" alt="<?php echo Yii::$app->name; ?>" style="width:186px;border:0; display:block;" alt="Logo" title="Logo" width="150" height="auto"/>
                        </a>
                    </td>
                </tr>
                <tr style="border-color: #fff;">
                    <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px; border-color: #fff; border:0;">
                        <h2 style="text-align: center;">Welcome to <?php echo Yii::$app->name; ?></h2>
                        <h4 style="text-align: left; color:#333; margin: 20px 0 10px 0;" >Dear <?php echo $model->first_name; ?>,</h4>
                        <p>Your account is successfully activated and thanks for connecting with us, we are hoping you will get your best partner as soon as possible. </p>
                        <h4 style="margin: 10px 0;"><strong>Step 1:</strong></h4>
                        <p>Please complete your profile</p>
                        <h4 style="margin: 10px 0;"><strong>Step 2:</strong></h4>
                        <p>Search your desired partner</p>
                        <h4 style="margin: 10px 0;"><strong>Step 1:</strong></h4>
                        <p>Talk with him/her and get marry.</p>
                        <br>
                        <p><strong>Best Regards,</strong></p>
                        <p><?php echo Yii::$app->name ?> Team</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>




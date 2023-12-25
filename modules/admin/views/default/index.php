<?php
$this->title = 'Dashboard - '.Yii::$app->name;
$new_users = app\models\Users::find()->where(['>=','date_created',date('Y-m-d')])->all();
$all_users = app\models\Users::find()->all();
?>
<div class="row">
    <div class="col-xs-12">
        <h4>Welcome!</h4>
    </div>
</div>
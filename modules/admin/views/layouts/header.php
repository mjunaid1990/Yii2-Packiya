<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

$user = app\models\Users::findOne(Yii::$app->user->id);
?>
<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- Messages: style can be found in dropdown.less-->
                <!-- Tasks: style can be found in dropdown.less -->
                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="/images/default.png" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?php if($user->email) { echo ucfirst($user->email);}else {echo 'Admin';} ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="/images/default.png" class="img-circle"
                                 alt="User Image"/>

                            <p>
                                <?php if($user->email) { echo ucfirst($user->email);}else {echo 'Admin';} ?>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php echo Yii::$app->urlManager->createUrl(['/admin/profile/update','id'=>$user->id]); ?>" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
            </ul>
        </div>
    </nav>
</header>

<script type="text/javascript">
    <?php $this->beginBlock('JS');?>
        $(document).ready(function(){
//            $('.dropdown-toggle').on('click',function(e){
//                e.preventDefault();
//                if($('.dropdown.user-menu').hasClass('open')) {
//                    $('.dropdown.user-menu').removeClass('open');
//                }else {
//                    $('.dropdown.user-menu').addClass('open');
//                }
//                
//            });
        });
    <?php $this->endBlock();?>
    <?php $this->registerJs($this->blocks['JS']);?>
</script>

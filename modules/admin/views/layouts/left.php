<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

$user = app\models\Users::findOne(Yii::$app->user->id);
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/images/default.png" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?php if($user->email) { echo ucfirst($user->email);}else {echo 'Admin';} ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <br />
        <!-- search form -->

        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
//                    ['label' => 'Home', 'icon' => 'home', 'url' => [Yii::$app->homeUrl]],
                    ['label' => 'Dashboard', 'icon' => 'home', 'url' => ['/admin/default/index']],
                    ['label' => 'Box Details', 'icon' => 'bar-chart', 'url' => ['/admin/box-details/index']],
                    ['label' => 'Product Categories', 'icon' => 'list', 'url' => ['/admin/product-child-categories/index']],
                    ['label' => 'Products', 'icon' => 'list', 'url' => ['/admin/products/index']],
                    ['label' => 'Product Images', 'icon' => 'list', 'url' => ['/admin/product-images/index']],
                    ['label' => 'Paper Material', 'icon' => 'list', 'url' => ['/admin/paper-meterial/index']],
                    ['label' => 'Reviews', 'icon' => 'star', 'url' => ['/admin/reviews/index']],
                    ['label' => 'Faqs', 'icon' => 'list', 'url' => ['/admin/faqs/index']],
                    ['label' => 'Shipping Rates', 'icon' => 'list', 'url' => ['/admin/shipping-rates/index']],
                    ['label' => 'Quantities', 'icon' => 'list', 'url' => ['/admin/quantities/index']],
                    ['label' => 'Settings', 'icon' => 'cog', 'url' => ['/admin/settings/index']],
                    ['label' => 'Pages', 'icon' => 'list', 'url' => ['/admin/pages/index']],
                    ['label' => 'Profile', 'icon' => 'user-circle-o', 'url' => ['/admin/profile/index','id'=>$user->id]],
                ],
            ]
        ) ?>

    </section>

</aside>

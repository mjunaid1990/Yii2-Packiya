<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">

            <div class="container">
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" ></script>
        <script src="https://js.stripe.com/v3/"></script>
            

        <script type="text/javascript">
            
            
            $(document).ready(function() {
                console.log('ready');
                const stripe = Stripe('pk_live_51LwUPGH1UhgKhd3qsrPYVvmXcJQl2wrvg3oQoMrWRuVHE1GXmdK0bZx9FaedJn1G7uqsfEzJwEIFjky9MGGhF38W00luiNJ1Bi');
//                const stripe = Stripe('pk_test_M0oqDuKsuy80UAfOVKAH9YXS00d94eJaX4');
                const elements = stripe.elements();
                const style = {
                    base: {
                        // Add your base input styles here. For example:
                        fontSize: '16px',
                        color: '#32325d',
                    }
                };

                // Create an instance of the card Element.
                const card = elements.create('card', {
                    hidePostalCode: true,
                    style: {
                        base: {
                            fontSize: '16px',
                            color: '#32325d'
                        },
                    }
                });

                // Add an instance of the card Element into the `card-element` <div>.
                card.mount('#card-element');
                
                $('#payment-form').on('submit', async (event) => {
                    event.preventDefault();
                    $('#pbtn').prop('disabled', true);
                    const {token, error} = await stripe.createToken(card);

                    if (error) {
                        // Inform the customer that there was an error.
                        const errorElement = document.getElementById('card-errors');
                        errorElement.textContent = error.message;
                        $('#pbtn').prop('disabled', false);
                    } else {
                        // Send the token to your server.
                        stripeTokenHandler(token);
                    }
                });
                
            })
            
            const stripeTokenHandler = (token) => {
                // Insert the token ID into the form so it gets submitted to the server
                const form = document.getElementById('payment-form');
                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);
                // Submit the form
                form.submit();
            }

        </script>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>

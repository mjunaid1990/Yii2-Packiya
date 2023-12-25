<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use app\models\LoginForm;
use app\models\Payments;
use app\models\PaymentEnq;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $user = \app\models\Users::findOne(Yii::$app->user->id);
            if($user->type == 1) {
                return $this->redirect('/admin');
            }else {
                return $this->goBack();
            }
            
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    
    public function actionInfo() {
        $model = new PaymentEnq();
        if ($model->load(Yii::$app->request->post())) {
            $model->payment_link = $model->generate_link();
            if($model->save()) {
                return $this->redirect(['checkout', 'id' => $model->payment_link]);
            }
        }
        return $this->render('user-info', [
            'model' => $model,
        ]);
    }
    
    public function actionCheckout($id) {
        $this->layout = 'checkout';
        $model = PaymentEnq::find()->where(['payment_link'=>$id, 'is_payment_done'=>null])->one();
        if (!$model) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        if (Yii::$app->request->post()) {
            
            \Stripe\Stripe::setApiKey('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');
//            \Stripe\Stripe::setApiKey('sk_test_moUXZxZUK86HtAMPS7yflHD300AigMYh4x');

            $token = $_POST['stripeToken'];

            $charge = \Stripe\Charge::create([
              'amount' => $model->amount * 100,
              'currency' => $model->currency,
              'description' => $model->firstname.' Payment',
              'source' => $token,
            ]);
            if($charge && $charge->captured == 1) {
                $payment = new Payments();
                $payment->payment_id = $charge->id;
                $payment->amount = $model->amount;
                $payment->enquiry_id = $model->id;
                $payment->email = $model->email;
                $payment->currency = $model->currency;
                if($payment->save()) {
                    $model->is_payment_done = 1;
                    $model->save();
                    
                    $message = Yii::$app->mailer->compose(['html' => '@app/mail/views/payment'], ['model' => $model]); // pass model to view);
                    $message->setTo($model->email);
                    $message->setSubject('Pakiya Order Confirmation');
                    $message->send();
                    
                    $message = Yii::$app->mailer->compose(['html' => '@app/mail/views/payment'], ['model' => $model]); // pass model to view);
                    $message->setTo('info@packiya.com');
                    $message->setSubject('Pakiya Order Confirmation');
                    $message->send();

                    $message = Yii::$app->mailer->compose(['html' => '@app/mail/views/payment'], ['model' => $model]); // pass model to view);
                    $message->setTo('mohammadjunaid538@gmail.com');
                    $message->setSubject('Pakiya Order Confirmation');
                    $message->send();
                    
                    return $this->redirect(['thanks']);
                    
                }
            }
        }
        return $this->render('checkout', [
            'model' => $model,
        ]);
    }
    
    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionThanks()
    {
        $this->layout = 'checkout';
        return $this->render('thanks');
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    
}

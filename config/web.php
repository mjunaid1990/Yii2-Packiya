<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name'=>'Packiya',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['languagepicker'],
    'on beforeRequest' => function ($event) {
//        Yii::$app->language = Yii::$app->session->get('language', 'en');
    },
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ]
    ],
    'components' => [
        'languagepicker' => [
            'class' => 'lajax\languagepicker\Component',
            'languages' => function () {                        // List of available languages (icons and text)
                return ['en'];
            },
            'cookieName' => 'language',                         // Name of the cookie.
            'expireDays' => 64,                                 // The expiration time of the cookie is 64 days.
        ],
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'sourceLanguage'=>'en',
                    'messageTable' => '{{%message}}',
                    'sourceMessageTable' => '{{%source_message}}',
                    'on missingTranslation' => function($event) {
                        $source = new app\models\SourceMessage();
                        $message = new app\models\Message();

                        $test = app\models\SourceMessage::find()
                                        ->where(['category' => $event->category, 'message' => $event->message]);

                        if($test->exists()) {
                                $data = $test->one();
                                $message->id = $data->id;
                        } else {
                                $source->category = $event->category;
                                $source->message  = $event->message;
                                $source->save();

//                                $message->id = $source->id;
                        }
//
//                        $message->language = $event->language;
//                        $message->translation = $event->message;
//                                            // there will be a [true] text befor every valid translation
//                        yii\helpers\VarDumper::dump($message->validate(),10,true);
//                        $message->save();
                },
                ]
            ]
        ],                
        'request' => [
            'baseUrl' => '',
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'IBQzLp-sKQSCovjGnediBRfDi4CKTt8R',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Users',
            'enableAutoLogin' => true
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false, 
            'viewPath' => '@app/mail',
            'enableSwiftMailerLogging'=>true,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.hostinger.com',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
                'username' => 'noreply@packiya.com',
                'password' => 'noreply!A@.123',
                'port' => '465', // Port 25 is a very common port too
                'encryption' => 'ssl', // It is often used, check your provider or mail server specs
            ],
            'messageConfig' => [
                'charset' => 'UTF-8',
                'from' => ['noreply@packiya.com' => 'Packiya Info'],
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning']
                ],
            ],
        ],
        'db' => $db,
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ''=>'site/index'
            ],
        ],
        
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
//    $config['bootstrap'][] = 'debug';
//    $config['modules']['debug'] = [
//        'class' => 'yii\debug\Module',
//        // uncomment the following to add your IP if you are not connecting from localhost.
//        //'allowedIPs' => ['127.0.0.1', '::1'],
//    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '*'],
    ];
}

return $config;

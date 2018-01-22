<?php
$config = [
    'homeUrl'=>Yii::getAlias('@frontendUrl'),
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute' => 'site/index',
    'bootstrap' => ['maintenance'],
    'modules' => [
        'user' => [
            'class' => 'frontend\modules\user\Module',
            'shouldBeActivated' => true
        ],
        'api' => [
            'class' => 'frontend\modules\api\Module',
            'modules' => [
                'v1' => 'frontend\modules\api\v1\Module'
            ]
        ],
        'favorites' => [
            'class' => 'thyseus\favorites\Module',
        ],
    ],
    'components' => [
        'assetManager' => [
            'appendTimestamp' => true,
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                /*'github' => [
                    'class' => 'yii\authclient\clients\GitHub',
                    'clientId' => env('GITHUB_CLIENT_ID'),
                    'clientSecret' => env('GITHUB_CLIENT_SECRET')
                ],*/
                'google' => [
                    'class' => 'yii\authclient\clients\Google',
                    'clientId' => 'google_client_id',
                    'clientSecret' => 'google_client_secret',
                ],
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => env('FACEBOOK_CLIENT_ID'),
                    'clientSecret' => env('FACEBOOK_CLIENT_SECRET'),
                    'scope' => 'email,public_profile',
                    'attributeNames' => [
                        'name',
                        'email',
                        'first_name',
                        'last_name',
                    ]
                ]
            ]
        ],
        'errorHandler' => [
            'errorAction' => 'site/error'
        ],
        'maintenance' => [
            'class' => 'common\components\maintenance\Maintenance',
            'enabled' => function ($app) {
                return $app->keyStorage->get('frontend.maintenance') === 'enabled';
            }
        ],
        'request' => [
            'cookieValidationKey' => env('FRONTEND_COOKIE_VALIDATION_KEY')
        ],
        'user' => [
            'class'=>'yii\web\User',
            'identityClass' => 'common\models\User',
            'loginUrl'=>['/user/sign-in/login'],
            'enableAutoLogin' => true,
            'as afterLogin' => 'common\behaviors\LoginTimestampBehavior'
        ],
        'formatter'=>[
            'class'=>\yii\i18n\Formatter::className(),
            'dateFormat' => 'php:d/m/Y',
            'datetimeFormat' => 'php:d/m/Y H:i:s',
            //'currencyCode' => 'IDR',
            'decimalSeparator' => ',',
            'thousandSeparator' => '.',
            'timeZone' => 'Asia/Jakarta',
            'numberFormatterOptions' => [
                NumberFormatter::DECIMAL_SEPARATOR_SYMBOL => '.',
                NumberFormatter::MAX_FRACTION_DIGITS => 0,
                NumberFormatter::FRACTION_DIGITS => 0,
                NumberFormatter::MIN_FRACTION_DIGITS => 0,
                NumberFormatter::MAX_FRACTION_DIGITS => 0,
            ],
            'numberFormatterSymbols' => [
                NumberFormatter::CURRENCY_SYMBOL => 'Rp ',
            ],
            'nullDisplay' => '',
        ],
    ]
];

if (YII_ENV_DEV) {
    $config['modules']['gii'] = [
        'class'=>'yii\gii\Module',
        'generators'=>[
            'crud'=>[
                'class'=>'yii\gii\generators\crud\Generator',
                'messageCategory'=>'frontend'
            ]
        ]
    ];
}

return $config;

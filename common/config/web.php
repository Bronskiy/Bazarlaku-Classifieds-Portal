<?php
$config = [
    'components' => [
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'linkAssets' => env('LINK_ASSETS'),
            'appendTimestamp' => YII_ENV_DEV
        ]
    ],
    'as locale' => [
        'class' => 'common\behaviors\LocaleBehavior',
        'enablePreferredLanguage' => true
    ],
];

if (YII_DEBUG) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.33.1', '172.17.42.1', '172.17.0.1', '192.168.99.1', '185.135.148.40', '89.255.92.236', '217.15.198.168'],
    ];
}

if (YII_ENV_DEV) {
    $config['modules']['gii'] = [
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.33.1', '172.17.42.1', '172.17.0.1', '192.168.99.1', '185.135.148.40', '89.255.92.236', '217.15.198.168'],
    ];
}


return $config;

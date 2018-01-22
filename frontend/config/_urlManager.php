<?php
return [
    'class'=>'yii\web\UrlManager',
    'enablePrettyUrl'=>true,
    'showScriptName'=>false,
    'rules'=> [

        // User
        ['pattern'=>'user/public/<id:\d+>', 'route'=>'user/public/index'],

        // Pages
        ['pattern'=>'page/<slug>', 'route'=>'page/view'],

        // Search
        ['pattern'=>'search/', 'route'=>'search/index'],

        // Articles
        ['pattern'=>'article/index', 'route'=>'article/index'],
        ['pattern'=>'article/attachment-download', 'route'=>'article/attachment-download'],
        ['pattern'=>'article/<slug>', 'route'=>'article/view'],

        // Classified
        ['pattern'=>'classified/post-classified', 'route'=>'classified/post-classified'],
        ['pattern'=>'classified/get-category', 'route'=>'classified/get-category'],
        ['pattern'=>'classified/get-city', 'route'=>'classified/get-city'],
        ['pattern'=>'classified/success', 'route'=>'classified/success'],
        ['pattern'=>'buysell/region/<region_id>/city/<city_id>', 'route'=>'classified/index'],
        ['pattern'=>'buysell/region/<region_id>', 'route'=>'classified/index'],
        ['pattern'=>'classified/<main_cat>/<sub_cat>/page/<page:\d+>', 'route'=>'classified/index'],
        ['pattern'=>'classified/<main_cat>/<sub_cat>', 'route'=>'classified/index'],
        ['pattern'=>'classified/<main_cat>/page/<page:\d+>', 'route'=>'classified/index'],
        ['pattern'=>'classified/<main_cat>', 'route'=>'classified/index'],
        ['pattern'=>'classified/', 'route'=>'classified/index'],

        // Detail
        ['pattern'=>'detail/<id:\d+>-<slug>', 'route'=>'detail/index'],

        // User
        ['pattern'=>'profile', 'route'=>'profile/index'],


        // Api
        ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/article', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/user', 'only' => ['index', 'view', 'options']]
    ]
];


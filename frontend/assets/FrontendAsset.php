<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\bootstrap\BootstrapAsset;
use yii\bootstrap\BootstrapPluginAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;
use common\assets\Html5shiv;

/**
 * Frontend application asset
 */
class FrontendAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $basePath = '@webroot';
    /**
     * @var string
     */
    public $baseUrl = '@web';

    public $css = [
        //'dist/css/bootstrap.min.css',
        'dist/css/font-awesome.min.css',
        'dist/css/icofont.css',
        'dist/flaticon/flaticon.css',
        'dist/css/owl.carousel.css',
        'dist/css/slidr.css',
        'dist/css/presets/preset1.css',
        'dist/css/main.css',
        'dist/css/responsive.css',
        'dist/css/file-upload-with-preview.min.css',
        'css/style.css',
    ];
    public $js = [
        /*  'dist/js/jquery.min.js',*/
        'dist/js/modernizr.min.js',
        //'dist/js/bootstrap.min.js',
        'dist/js/owl.carousel.min.js',
        'dist/js/smoothscroll.min.js',
        'dist/js/scrollup.min.js',
        'dist/js/jquery.sidr.min.js',
        'dist/js/price-range.js',
        'dist/js/jquery.countdown.js',
        'dist/js/file-upload-with-preview.min.js',
        'dist/js/custom.js',
    ];


    /**
     * @var array
     */
    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
        Html5shiv::class,
        BootstrapPluginAsset::class
    ];
}

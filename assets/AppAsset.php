<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
//    public $css = [
//        //'css/site.css',
//        /* font arbic */
//        //'https://fonts.googleapis.com/css2?family=Markazi+Text:wght@300,400,500,600',
//        /* Themefisher Icon font */
//        'plugins/themefisher-font/style.css',
//        /* bootstrap.min css */
//        'plugins/bootstrap/css/bootstrap.min.css',
//        /* Revolution Slider */
//        'plugins/revolution-slider/revolution/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css',
//        'plugins/revolution-slider/revolution/fonts/font-awesome/css/font-awesome.css',
//        /* REVOLUTION STYLE SHEETS */
//        'plugins/revolution-slider/revolution/css/settings.css',
//        'plugins/revolution-slider/revolution/css/layers.css',
//        'plugins/revolution-slider/revolution/css/navigation.css',
//        /* Main Stylesheet */
//        'css/style.css',
//    ];
//    public $js = [
//        /* Main jQuery */
//        'plugins/jquery/dist/jquery.min.js',
//        /* Bootstrap 3.1 */
//        'plugins/bootstrap/js/bootstrap.min.js',
//        /* Bootstrap Touchpin */
//        'plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js',
//        /* Instagram Feed Js */
//        'plugins/instafeed-js/instafeed.min.js',
//        /* Video Lightbox Plugin */
//        'plugins/ekko-lightbox/dist/ekko-lightbox.min.js',
//        /* Count Down Js */
//        'plugins/SyoTimer/build/jquery.syotimer.min.js',
//        /* Revolution Slider */
//        'plugins/revolution-slider/revolution/js/jquery.themepunch.tools.min.js',
//        'plugins/revolution-slider/revolution/js/jquery.themepunch.revolution.min.js',
//        /* Revolution Slider */
//        'plugins/revolution-slider/revolution/js/extensions/revolution.extension.actions.min.js',
//        'plugins/revolution-slider/revolution/js/extensions/revolution.extension.carousel.min.js',
//        'plugins/revolution-slider/revolution/js/extensions/revolution.extension.kenburn.min.js',
//        'plugins/revolution-slider/revolution/js/extensions/revolution.extension.layeranimation.min.js',
//        'plugins/revolution-slider/revolution/js/extensions/revolution.extension.migration.min.js',
//        'plugins/revolution-slider/revolution/js/extensions/revolution.extension.navigation.min.js',
//        'plugins/revolution-slider/revolution/js/extensions/revolution.extension.parallax.min.js',
//        'plugins/revolution-slider/revolution/js/extensions/revolution.extension.slideanims.min.js',
//        'plugins/revolution-slider/revolution/js/extensions/revolution.extension.video.min.js',
//        'plugins/revolution-slider/assets/warning.js',
//        /* Google Mapl */
//        'https://maps.googleapis.com/maps/api/js?key=AIzaSyCC72vZw-6tGqFyRhhg5CkF2fqfILn2Tsw',
//        'plugins/google-map/gmap.js',
//        /* Main Js File */
//        'js/script.js',
//    ];
    public $css = [
        'css/plugins.css',
        'css/style.css',
        'css/stylertl.css',
    ];
    public $js = [
//        'js/jquery.js',
        'js/plugins.js',
        'js/plugins2.js',
        'js/custom.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

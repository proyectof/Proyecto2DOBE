<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/bootstrap-datetimepicker.min.css',
        'css/yeti.min.css',
        'css/gallery/blueimp-gallery.min.css',
        'css/gallery/bootstrap-image-gallery.css',
        //'css/gallery/demo.css',
    ];
    public $js = [
        'js/moment.js',
        'js/bootstrap-datetimepicker.js',
        'js/main.js',
        'js/gallery/jquery.blueimp-gallery.min.js',
        'js/gallery/bootstrap-image-gallery.js',
        'js/gallery/demo.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

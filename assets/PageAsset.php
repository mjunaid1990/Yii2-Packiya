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
class PageAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
        '//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&amp;subset=devanagari,latin-ext',
        '//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese',
        'css/jquery-ui.css',
        'css/nikaah.css',
        'css/modal.css',
        'css/bcss.css',
    ];
    public $js = [
        
        'js/jquery-ui.min.js',
        'js/memberHeader.js',
        'js/global.js',
        'js/multiple-select.js',
        'js/jquery.jscrollpane.min.js',
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}

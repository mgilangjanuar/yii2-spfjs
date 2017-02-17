<?php
/**
 * SpfAssetBundle.php
 * @author Muhammad Gilang Januar
 * @link http://mgilangjanuar.com
 */

namespace mgilangjanuar\yii2spf;

/**
 * Class SpfAssetBundle
 * @package mgilangjanuar\yii2spf\assets
 */
class SpfAssetBundle extends \yii\web\AssetBundle
{

    /**
     * @inherit
     */
    public $sourcePath = '@vendor/mgilangjanuar/yii2-spfjs';

    /**
     * @inherit
     */
    public $js = [
        'web/libs/spf/dist/spf.js',
        'web/src/js/initialize-spf.js',
    ];

    /**
     * @inherit
     */
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}

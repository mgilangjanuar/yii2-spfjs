<?php
/**
 * PaceAssetBundle.php
 * @author Muhammad Gilang Januar
 * @link http://mgilangjanuar.com
 */

namespace mgilangjanuar\yii2spf\assets;

/**
 * Class PaceAssetBundle
 * @package mgilangjanuar\yii2spf\assets
 */
class PaceAssetBundle extends \yii\web\AssetBundle
{

    /**
     * @inherit
     */
    public $sourcePath = '@vendor/mgilangjanuar/yii2-spfjs';

    public $jsOptions=['position' => \yii\web\View::POS_END];

    public function registerAssetFiles($view){
        $this->js = 'web/libs/PACE/pace.min.js';
        parent::registerAssetFiles($view);
    }

    /**
     * @inherit
     */
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}

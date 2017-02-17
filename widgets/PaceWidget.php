<?php
/**
 * SpfAssetBundle.php
 * @author Muhammad Gilang Januar
 * @link http://mgilangjanuar.com
 */

namespace mgilangjanuar\yii2spf\widgets;

use Yii;
use yii\base\Widget;
use yii2spf\assets\PaceAssetBundle;
use yii\web\View;

/**
 * Class PaceWidget
 * @package mgilangjanuar\yii2spf\widgets
 */
class PaceWidget extends Widget
{
    public $color = 'red';

    public $theme = 'minimal';

    public $options = [
        'ajax'=>['trackMethods'=>['GET','POST','AJAX']]
    ];

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        if(! empty($this->options)) {
            $this->getView()->registerJs('window.paceOptions=' . json_encode($this->options), View::POS_BEGIN);
        }

        PaceAssetBundle::register($this->getView());

        $asset = Yii::$app->assetManager->publish('@vendor/mgilangjanuar/yii2-spfjs', ['forceCopy'=>YII_DEBUG]);
        
        $this->getView()->registerCssFile($asset[1] . '/web/libs/PACE/themes/' . $this->color . '/pace-theme-' . $this->theme . '.css');
    }
}
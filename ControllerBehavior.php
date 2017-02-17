<?php
/**
 * Controller.php
 * @author Muhammad Gilang Januar
 * @link http://mgilangjanuar.com
 */

namespace mgilangjanuar\yii2spf;

use yii\web\Controller;
use yii\base\Behavior;
use yii\helpers\Json;

/**
 * Class ControllerBehavior
 * @package mgilangjanuar\yii2spf\behaviors
 */
class ControllerBehavior extends Behavior
{
    /**
     * attribute title array
     */
    public $title = ['contentBetween' => ['<title>', '</title>']];

    /**
     * attribute styles array
     */
    public $styles = ['contentBetween' => ['<!-- STYLES CONTENT -->', '<!-- END OF STYLES CONTENT -->']];
    
    /**
     * attribute body array
     */
    public $body = [
        'main-content' => ['contentBetween' => ['<!-- MAIN CONTENT -->', '<!-- END OF MAIN CONTENT -->']]
    ];

    /**
     * attribute scripts array
     */
    public $scripts = ['contentBetween' => ['<!-- SCRIPTS CONTENT -->', '<!-- END OF SCRIPTS CONTENT -->']];

    /**
     * @inherit
     */
    public function events()
    {
        return [
            Controller::EVENT_AFTER_ACTION => 'afterAction',
        ];
    }

    /**
     * Method triggered by afterAction method in active controller
     */
    public function afterAction($event)
    {
        $result = $event->result;

        if (Yii::$app->request->get('spf') == 'navigate') {
            echo Json::encode($this->getMetaTags($result));
            die();
        }

        return $result;
    }

    private function getMetaTags($str, $metaTags = null)
    {
        $results = [];
        $metaTags = $metaTags ? $metaTags : (['title' => $this->title] + ['head' => $this->styles] + ['body' => $this->body] + ['foot' => $this->scripts]);
        foreach ($metaTags as $tag => $meta) {
            if (isset($meta['contentBetween']) && count($meta['contentBetween']) == 2) {
                $results[$tag] = $this->getContentsBetween($str, $meta['contentBetween'][0], $meta['contentBetween'][1]);
            } else {
                $results[$tag] = $this->getMetaTags($str, $meta);
            }
        }
        return $results;
    }

    private function getContentsBetween($str, $startDelimiter, $endDelimiter, $index = 0)
    {
        $contents = array();
        $startDelimiterLength = strlen($startDelimiter);
        $endDelimiterLength = strlen($endDelimiter);
        $startFrom = $contentStart = $contentEnd = 0;
        while (false !== ($contentStart = strpos($str, $startDelimiter, $startFrom))) {
            $contentStart += $startDelimiterLength;
            $contentEnd = strpos($str, $endDelimiter, $contentStart);
            if (false === $contentEnd) {
                break;
            }
            $contents[] = substr($str, $contentStart, $contentEnd - $contentStart);
            $startFrom = $contentEnd + $endDelimiterLength;
        }

        return $contents[$index];
    }
}
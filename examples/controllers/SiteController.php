<?php

namespace app\controllers;

use Yii;
use yii2spf\behaviors\ControllerBehavior as Yii2Spf;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            // add yii2spf behavior
            'spfjs' => [
                'class' => Yii2Spf::className(),

                // default attributes value
                'title' => [
                    'contentBetween' => ['<title>', '</title>']
                ],
                'styles' => [
                    'contentBetween' => ['<!-- STYLES CONTENT -->', '<!-- END OF STYLES CONTENT -->']
                ],
                'body' => [
                    // get from id #main-content content
                    'main-content' => ['contentBetween' => ['<!-- MAIN CONTENT -->', '<!-- END OF MAIN CONTENT -->']]
                ],
                'scripts' => [
                    'contentBetween' => ['<!-- SCRIPTS CONTENT -->', '<!-- END OF SCRIPTS CONTENT -->']
                ],
            ],

            // others behaviors here...
        ];
    }

    // others method here...
}
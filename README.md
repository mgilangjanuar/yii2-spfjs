# yii2-spfjs

This is an extension for yii2 with *spfjs* ([github.com/youtube/spfjs](https://github.com/youtube/spfjs)) for fast navigation 
and with *pace* ([github.com/HubSpot/pace](https://github.com/HubSpot/pace)) for web page progress bar.

## Get Started

### Setup AppAsset

Add this in depends attribute in your ```AppAsset``` class

```
public $depends = [
    // other depends bundle here
    'mgilangjanuar\yii2spf\SpfAssetBundle',
];
```

### Setup Controller

In all controllers you want, implement method ```behaviors()``` and add this

```
public function behaviors()
{
    return [
        // add yii2spf behavior
        'spfjs' => [
            'class' => \mgilangjanuar\yii2spf\ControllerBehavior::className(),

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

                // you can add others elements in body here
                // ...
            ],
            'scripts' => [
                'contentBetween' => ['<!-- SCRIPTS CONTENT -->', '<!-- END OF SCRIPTS CONTENT -->']
            ],
        ],

        // others behaviors here...
    ];
}
```

### Setup Main Layout

After register ```AppAsset``` in your main layout, add this for *pace* widget

```
\mgilangjanuar\yii2spf\PaceWidget::widget([
    'color'=>'red',
    'theme'=>'minimal',
    'options'=>[
        'ajax'=>['trackMethods'=>['GET','POST','AJAX']]
    ]
]);
```

Find ```<?php $this->head() ?>``` in main layout and add this comments line between that code

```
<!-- STYLES CONTENT -->
<?php $this->head() ?>
<!-- END OF STYLES CONTENT -->
```

Find ```<?php $this->endBody() ?>``` and add this comments line between that

```
<!-- SCRIPTS CONTENT -->
<?php $this->endBody() ?>
<!-- END OF SCRIPTS CONTENT -->
```

And finnaly, add this comments line between your dynamic content and add div tag with id ```main-content```
(or as you defined in behavior method in your class).

```
<div id="main-content" class="container">
<!-- MAIN CONTENT -->
<?= Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>
<?= $content ?>
<!-- END OF MAIN CONTENT -->
</div>
```


## License

yii2-spfjs is released under the MIT License. See the bundled [LICENSE.md](LICENSE.md)
for details.
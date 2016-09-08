<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules' => [
            'redactor' => [
                    'class' => 'yii\redactor\RedactorModule',
                    'imageAllowExtensions'=>['jpg','png','gif'],
                    'uploadDir'=>'@webroot/uploads/redactor',
                    'uploadUrl' => '@web/uploads/redactor'
            ],
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];

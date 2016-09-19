<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=prd-watch-0.cluster-cvdmtb0k71f6.us-west-2.rds.amazonaws.com;dbname=warranty_ticwear',
            'username' => 'warranty_ticwear',
            'password' => 'plhqrCjUHWBmOC0h',
            'charset' => 'utf8',
        	'tablePrefix' => 'tbl_',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
        ],
    ],
];

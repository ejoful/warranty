<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Warranty Service',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        // ['label' => 'ReturnProduct', 'url' => ['/info/index']],
    ];

    if (empty(Yii::$app->session['user'])) {
    	
    	$menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup'], 'visible' => Yii::$app->user->isGuest];
    	$menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = ['label' => 'ReturnProduct', 'url' => ['/info/index']];
    	$menuItems[] = ['label' => 'MyHistory', 'url' => ['/form-info/index','id'=>Yii::$app->session['user']->base_info->wwid]];
    	
    	$username = '';
    	if (!empty(Yii::$app->session['user']->base_info->username)) {
    		$username = Yii::$app->session['user']->base_info->username;
    	} else if (!empty(Yii::$app->session['user']->base_info->nickname)) {
    		$username = Yii::$app->session['user']->base_info->nickname;
    	} else {
    		$username = Yii::$app->session['user']->base_info->email;
    	}
    	
    	$menuItems[] = ['label' => 'Logout (' . $username . ')',
    			'url' => ['/site/logout'],
    			];
    }
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Mobvoi <?= date('Y') ?></p>
    </div>
</footer>
<script type="text/javascript">
    $("#w1 .signup").on('click', function() {
        $.ajax({
            url:"<?=Url::to(['site/signup'],true)?>",
            type:'post',
            success:function(data){
                console.log("success");
            }
        });
    });
    $("#w1 .login").on('click', function() {
        $.ajax({
            url:"<?=Url::to(['site/signup'],true)?>",
            type:'post',
            success:function(data){
                console.log("success");
            }
        });
    });
</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

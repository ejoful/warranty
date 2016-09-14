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
        ['label' => 'ReturnProduct', 'url' => ['/info/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'MyHistory', 'url' => ['/form-info/index','id'=>1]];
        $menuItems[] = ['label' => 'Signup','url' => ['/site/signup'], 'visible' => Yii::$app->user->isGuest,'options'=>['class'=>'signup']];
        $menuItems[] = ['label' => 'Login','url' => ['/site/login'],'options'=>['class'=>'login']];
     } else {
        $menuItems[] = ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
        'url' => ['/user/security/logout'],
        'linkOptions' => ['data-method' => 'post']];
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
        console.log("signup come in");
        $.ajax({
            url:"<?=Url::to(['site/signup'],true)?>",
            type:'post',
            success:function(data){
                console.log(123);
            }
        });
    });
    $("#w1 .login").on('click', function() {
        console.log("login come in");
        $.ajax({
            url:"<?=Url::to(['site/signup'],true)?>",
            type:'post',
            success:function(data){
                console.log(123);
            }
        });
    });
</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

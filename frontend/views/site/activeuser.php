<?php

/* @var $this yii\web\View */

use frontend\assets\AppAsset;
use yii\helpers\Url;

use yii\helpers\Html;
AppAsset::addCss($this,"@web/css/auth.css");

$this->title = 'Active user';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="active-page-msg">
	<h2><?= $msg['msg'] ?></h2>
</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Sp */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Sp',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="sp-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

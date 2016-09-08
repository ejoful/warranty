<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Check */

$this->title = Yii::t('app', 'Create Check');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Checks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="check-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

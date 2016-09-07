<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Fp */

$this->title = Yii::t('app', 'Create Fp');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

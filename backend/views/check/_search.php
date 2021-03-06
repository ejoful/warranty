<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CheckSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="check-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fpid') ?>

    <?= $form->field($model, 'spid') ?>

    <?= $form->field($model, 'des') ?>

    <?= $form->field($model, 'position') ?>

    <?php // echo $form->field($model, 'yes') ?>

    <?php // echo $form->field($model, 'no') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

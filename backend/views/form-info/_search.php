<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\FormInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'consumer_name') ?>

    <?= $form->field($model, 'consumer_phone') ?>

    <?= $form->field($model, 'watch_id') ?>

    <?= $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'firstlevel_problem') ?>

    <?php // echo $form->field($model, 'secondlevel_problem') ?>

    <?php // echo $form->field($model, 'problem_des') ?>

    <?php // echo $form->field($model, 'photo') ?>

    <?php // echo $form->field($model, 'video') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

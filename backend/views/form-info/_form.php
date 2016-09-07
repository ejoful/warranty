<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\FormInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'consumer_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'consumer_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'watch_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'firstlevel_problem')->textInput() ?>

    <?= $form->field($model, 'secondlevel_problem')->textInput() ?>

    <?= $form->field($model, 'problem_des')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'photo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'video')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'update_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

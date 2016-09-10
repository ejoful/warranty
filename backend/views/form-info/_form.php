<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Lookup;

/* @var $this yii\web\View */
/* @var $model backend\models\FormInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-info-form">

    <?php $form = ActiveForm::begin(); ?>
	
	<label class="control-label" for="forminfo-consumer_name">用户姓名:&nbsp;&nbsp;<?= $model->consumer_name; ?></label>
	
	
    <?php // $form->field($model, 'consumer_name')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'consumer_phone')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'watch_id')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'country')->textInput() ?>

    <?php // $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'firstlevel_problem')->textInput() ?>

    <?php // $form->field($model, 'secondlevel_problem')->textInput() ?>

    <?php // $form->field($model, 'certificate')->textarea(['rows' => 6]) ?>

    <?php // $form->field($model, 'problem_des')->textarea(['rows' => 6]) ?>

    <?php // $form->field($model, 'video')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList(Lookup::items('ReviewStatus')) ?>

    <?php // $form->field($model, 'update_time')->textInput() ?>

    <?php // $form->field($model, 'wwid')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'reviewerid')->textInput() ?>

    <?php // $form->field($model, 'logisid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

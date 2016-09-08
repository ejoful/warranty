<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Fp;

/* @var $this yii\web\View */
/* @var $model backend\models\Sp */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sp-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fpid')->dropDownList(Fp::items()) ?>
    
    <?= $form->field($model, 'des')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position')->textInput() ?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

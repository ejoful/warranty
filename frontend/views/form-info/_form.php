<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use frontend\assets\AppAsset;
use backend\models\Country;
use backend\models\Fp;
use backend\models\Sp;
use yii\redactor\widgets\Redactor;

AppAsset::addCss($this,"@web/css/history.css");
/* @var $this yii\web\View */
/* @var $model frontend\models\FormInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'watch_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'consumer_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'consumer_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country')->dropDownList(Country::items()) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zip_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'firstlevel_problem')->dropDownList(
        Fp::items(),
        ['prompt' => 'please select:']
    ) ?>

    <?= $form->field($model, 'secondlevel_problem')->dropDownList(
        Sp::items($model->firstlevel_problem),
        ['prompt' => 'please select:'])
    ?>

     <?= $form->field($model, 'video')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'problem_des')->widget(Redactor::className(), [
      'clientOptions' => [
        'minHeight' => 300,
        'lang' => 'zh_cn',
      ]]) ?>
    
    <?= $form->field($model, 'certificate')->widget(Redactor::className(), [
      'clientOptions' => [
        'minHeight' => 300,
        'lang' => 'zh_cn',
      ]]) ?>

    <!-- <?= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'update_time')->textInput() ?>

    <?= $form->field($model, 'wwid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reviewerid')->textInput() ?>

    <?= $form->field($model, 'logisid')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<script>
        $("#forminfo-firstlevel_problem").change(function () {
            var fid=$("#forminfo-firstlevel_problem").val();
            $.ajax({
                url: "<?= yii::$app->urlManager->createUrl(['form-info/items']); ?>",
                method: "post",
                data: {fid:fid},
                success: function (data) {
                    console.log(data);
                    if(data){
                        $("#forminfo-secondlevel_problem").html(data);
                    }
                    else{
                        $("#forminfo-secondlevel_problem").html("no option");
                    }
                }
            });
        });
</script>

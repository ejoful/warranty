<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Country;
use backend\models\Fp;
use backend\models\Sp;
use backend\models\Lookup;
use kartik\datetime\DateTimePicker;
use yii\redactor\widgets\Redactor;

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

    <?= $form->field($model, 'country')->dropDownList(Country::items()) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'firstlevel_problem')->dropDownList(
        Fp::items(),
        ['prompt' => '请选择']
    ) ?>

    <?= $form->field($model, 'secondlevel_problem')->dropDownList(
        Sp::items($model->firstlevel_problem),
        ['prompt' => '请选择'])
    ?>

    <?= $form->field($model, 'problem_des')->widget(Redactor::className(), [
      'clientOptions' => [
        'minHeight' => 300,
        'lang' => 'zh_cn',
      ]]) ?>

    <?= $form->field($model, 'video')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'create_time')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => 'Enter create_time ...'],
        'pluginOptions' => [
            'autoclose' => true
        ]
    ]); ?>

     <?= $form->field($model, 'update_time')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => 'Enter update_time ...'],
        'pluginOptions' => [
            'autoclose' => true
        ]
    ]); ?>

    <?= $form->field($model, 'status')->dropDownList(Lookup::items('ReviewStatus')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript" src="/js/jquery.min.js"></script>
<script>
        $("#forminfo-firstlevel_problem").change(function () {
            var fid=$("#forminfo-firstlevel_problem").val();
            $.ajax({
                url: "<?php echo yii::$app->urlManager->createUrl('sp/items'); ?>",
                method: "post",
                data: {fid:fid},
                success: function (data) {
                    $("#forminfo-secondlevel_problem").append(data);
                }
            });
        });
</script>

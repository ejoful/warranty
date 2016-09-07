<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Fp;
use backend\models\Sp;

/* @var $this yii\web\View */
/* @var $model backend\models\Check */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="check-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fpid')->dropDownList(
        Fp::items(),
        ['prompt' => '请选择']
    ) ?>

    <?= $form->field($model, 'spid')->dropDownList(
        // Sp::items($model->fpid),
        ['prompt' => '请选择'])
    ?>

    <?= $form->field($model, 'des')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'position')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script>
        $("#check-fpid").change(function () {
            var fid=$("#check-fpid").val();
            $.ajax({
                url: "<?php echo yii::$app->urlManager->createUrl('sp/items'); ?>",
                method: "post",
                data: {fid:fid},
                success: function (data) {
                    $("#check-spid").html(data);
                }
            });
        });
</script>
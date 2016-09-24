<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Fp;
use backend\models\Sp;
use frontend\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $model backend\models\Check */
/* @var $form yii\widgets\ActiveForm */

AppAsset::addCss($this,"@web/css/check.css"); 
?>

<div class="check-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fpid')->dropDownList(
        Fp::items(),
        ['prompt' => '请选择']
    ) ?>

    <?= $form->field($model, 'spid')->dropDownList(
        Sp::items($model->fpid),
        ['prompt' => '请选择'])
    ?>

    <?= $form->field($model, 'des')->textarea(['rows' => 6]) ?>
    
    <?= $form->field($model, 'yes')->textInput(['maxlength' => true]) ?>
    <div class="tip">
        <label>此文本框包含3种填写格式：</label><br>
        <label>第一种：0_right/wrong_描述信息，'0'代表该检查策略能够确定用户遇到的问题，'right'代表成功解决了用户遇到的问题，'wrong'代表遇到此问题时直接给用户换货，'描述信息'是给用户返回的弹窗信息</label><br>
        <label>第二种：1_#数字：意思是调到下一检查步骤</label><br>
        <label>第三种：2_return：意思是返回到issue RMA页面</label>
    </div>
    
   <?= $form->field($model, 'no')->textInput(['maxlength' => true]) ?>
   <div class="tip">
        <label>规则同上</label><br>
    </div> 

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
                type: 'get',
                dataType: 'html',
                data: {
                    fid:fid,
                    _csrf:$('meta[name=csrf-token]').attr('content'),
                },
                success: function (data) {
                    $("#check-spid").html(data);
                }
            });
        });
        $("#check-yes").blur(function() {
            var check_yes = $(this).val();
            var reg = /^[0-2]_/gi;
            if(!reg.test(check_yes)){
                alert("输入不合法");
                $(this).focus();
            }
        });
        $("#check-no").blur(function() {
            var check_yes = $(this).val();
            var reg = /^[0-2]_/gi;
            if(!reg.test(check_yes)){
                alert("输入不合法");
                $(this).focus();
            }
        });
</script>
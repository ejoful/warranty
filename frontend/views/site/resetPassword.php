<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please choose your new password:</p>

    <div class="row">
        <div class="col-lg-5">

				<label class="control-label" for="resetpasswordform-password">password</label>
                <input type="text" id="resetpasswordform-password" class="form-control" name="ResetPasswordForm[password]" value="" autofocus="">
                
                <p class="help-block help-block-error"></p>
                

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                </div>

        </div>
    </div>
</div>
<script type="text/javascript">
$('.btn-primary').click(function(){
	$.ajax({
		url: '<?= Url::to(['site/reset-password','lang'=> 'en', 'email' => $email, 'token' => $token]) ?>',
		method: 'post',
		data: {
			password: $('#resetpasswordform-password').val(),
			lang: 'en',
			_csrf: $('meta[name=csrf-token]').attr('content'),
		},
		dataType: 'json',
		success: function(data) {
			console.log(data);
			if (data.status == 'success') {
				alert(data.msg);
				window.location.href = '<?= Url::to(['site/index'],true) ?>';
			} else {
				alert(data.msg);
			}
		}

	});
	
});


</script>








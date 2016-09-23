<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-request-password-reset">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out your email. A link to reset password will be sent there.</p>

    <div class="row">
        <div class="col-lg-5">

                <label class="control-label" for="passwordresetrequestform-email">Email</label>
                <input type="text" id="passwordresetrequestform-email" class="form-control" name="PasswordResetRequestForm[email]" value="" autofocus="">
                
                <p class="help-block help-block-error"></p>

                <div class="form-group">
                    <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
                </div>

            
        </div>
    </div>
</div>

<script type="text/javascript">
$('.btn-primary').click(function(){
	$.ajax({
		url: '<?= Url::to(['site/request-password-reset']) ?>',
		method: 'post',
		data: {
			email: $('#passwordresetrequestform-email').val(),
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
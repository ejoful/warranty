<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;


$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <div class="row">
        <div class="col-lg-5">
        
			
			                <div class="form-group field-loginform-email required">
			<label class="control-label" for="loginform-email">Email</label>
			<input type="text" id="loginform-email" class="form-control" name="email" autofocus>
			
			<p class="help-block help-block-error"></p>
			</div>
			                <div class="form-group field-loginform-password required">
			<label class="control-label" for="loginform-password">Password</label>
			<input type="password" id="loginform-password" class="form-control" name="password">
			
			<p class="help-block help-block-error"></p>
			</div>
			
			<div style="color:#999;margin:1em 0">
			    If you forgot your password you can <a href="/index.php?r=site%2Frequest-password-reset">reset it</a>.
			</div>
			<div class="form-group">
				<div class="btn btn-primary" name="login-button">Login</div>
			</div>

        
        
        </div>
    </div>
</div>

<script>

$(".btn-primary").click(function(){



	$.ajax({
			url: '<?= Url::to(['site/login'], true) ?>',
			method: 'post',
			data: {
					email: $('#loginform-email').val(),
					password: $('#loginform-password').val(),
					_csrf: $('meta[name=csrf-token]').attr('content'),
					language: $('html').attr('lang'),
				},
			dataType: 'json',
			success: function(data) {
					console.log(data);
					if (data.status == 'success') {
						window.location.href = '<?= Url::to(['site/index'],true) ?>';
					} else {
						alert(data.msg);
					}
				}

		});
});


</script>








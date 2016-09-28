<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use frontend\assets\AppAsset;

$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;

AppAsset::addCss($this,"@web/css/login.css");
?>
<div class="login-title">
	<p>
		Welcome to the Warranties service.<br>
		Before requesting to return the product,please take a look at our <br>
		FAQ section to see if your problem can be solved:FAQ
	</p>
</div>
<div class="site-login">
	<h1>Ticwear Account</h1>
	<p>Please log in with the account information you used for Ticwear</p>
	<div class="row">
		<div class="col-lg-5">
			<div class="form-group field-loginform-email required">
				<!-- <label class="control-label" for="loginform-email">Email</label> -->
				<img src="<?= Url::to('@web/img/email.png', true); ?>">
				<input type="text" id="loginform-email" class="form-control" name="email" autofocus placeholder="E-mail" autocomplete="off">

				<p class="help-block help-block-error"></p>
			</div>
			<div class="form-group field-loginform-password required">
				<!-- <label class="control-label" for="loginform-password">Password</label> -->
				<img src="<?= Url::to('@web/img/pass.png', true); ?>">
				<input type="password" id="loginform-password" class="form-control" name="password" placeholder="Password" autocomplete="off">

				<p class="help-block help-block-error"></p>
			</div>
			
			<div class="forget-pass">
				<a href="/index.php?r=site%2Frequest-password-reset">Forgot password</a>
			</div>
			<div class="form-group">
				<div class="btn btn-primary" name="login-button">Sign in</div>
			</div>
			<div class="signup">
				<a href="/index.php?r=site%2Fsignup">Don't have an ID? Create one now.</a>
			</div>
			<div class="policy">
				<a href="/index.php?r=site%2Findex">Check Ticwatch Limited Warranty Policy Here</a>
			</div>
			<div class="note">Note:Please use the same 3rd party login  you used for your Ticwear app</div>
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
				language: 'en',
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








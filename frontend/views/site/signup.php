<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
        
                <div class="form-group field-signupform-username required">
<label class="control-label" for="signupform-username">Username</label>
<input type="text" id="signupform-username" class="form-control" name="SignupForm[username]" autofocus>

<p class="help-block help-block-error"></p>
</div>
                <div class="form-group field-signupform-email required">
<label class="control-label" for="signupform-email">Email</label>
<input type="text" id="signupform-email" class="form-control" name="SignupForm[email]">

<p class="help-block help-block-error"></p>
</div>
                <div class="form-group field-signupform-password required">
<label class="control-label" for="signupform-password">Password</label>
<input type="password" id="signupform-password" class="form-control" name="SignupForm[password]">

<p class="help-block help-block-error"></p>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary" name="signup-button">Signup</button>
</div>


        </div>
    </div>
</div>


<script>

$(".btn-primary").click(function(){

	$.ajax({
			url: '<?= Url::to(['site/signup'], true) ?>',
			method: 'post',
			data: {
					username: $('#signupform-email').val(),
					email: $('#signupform-email').val(),
					password: $('#signupform-password').val(),
					language: 'en',
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














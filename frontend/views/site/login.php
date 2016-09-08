<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <div class="row">
        <div class="col-lg-5">
        
			
			                <div class="form-group field-loginform-username required">
			<label class="control-label" for="loginform-username">Username</label>
			<input type="text" id="loginform-username" class="form-control" name="LoginForm[username]" autofocus>
			
			<p class="help-block help-block-error"></p>
			</div>
			                <div class="form-group field-loginform-password required">
			<label class="control-label" for="loginform-password">Password</label>
			<input type="password" id="loginform-password" class="form-control" name="LoginForm[password]">
			
			<p class="help-block help-block-error"></p>
			</div>
			<div class="form-group field-loginform-rememberme">
			<div class="checkbox">
			<label for="loginform-rememberme">
			<input type="hidden" name="LoginForm[rememberMe]" value="0"><input type="checkbox" id="loginform-rememberme" name="LoginForm[rememberMe]" value="1" checked>
			Remember Me
			</label>
			<p class="help-block help-block-error"></p>
			</div>
			</div>
			<div style="color:#999;margin:1em 0">
			    If you forgot your password you can <a href="/index.php?r=site%2Frequest-password-reset">reset it</a>.
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary" name="login-button">Login</button>
			</div>

        
        
        </div>
    </div>
</div>

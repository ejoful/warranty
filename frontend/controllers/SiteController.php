<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use backend\models\UserData;
use yii\helpers\Url;



/**
 * Site controller
 */
class SiteController extends Controller
{


    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    private $error_message = [
    		// User register message
    		'0'=>[
    				'cn' => '成功',
    				'en' => 'Success',
    		],
    		'100'=>[
    				'cn' => "用户不存在",
    				'en' => "User not exists",
    		] ,
    		'101'=>[
    				'cn' => "用户已存在",
    				'en' => "User already exists",
    		],
    		'102'=>[
    				'cn' => "该手机号码已经注册，请直接登陆",
    				'en' => "The phone number has already been registered, please login in",
    		],
    		'103'=>[
    				'cn' => "该邮箱已经注册，请直接登陆",
    				'en' => "The email has already been registered, please login in ",
    		],
    		'104'=>[
    				'cn' => "邮件类型不支持",
    				'en' => "Email type not supported",
    		],
    		'105'=>[
    				'cn' => "该第三方账号已经授权，请直接登陆",
    				'en' => "The account has already authorized, please login in",
    		],
    		'106'=>[
    				'cn' => "请求参数错误",
    				'en' => "Illegal request parameter",
    		],
    		'107'=>[
    				'cn' => "未知账户类型错误",
    				'en' => "Unknown account type",
    		],
    		'301'=>[
    				'cn' => "用户名或者密码错误",
    				'en' => "Wrong password",
    		],
    		'302'=>[
    				'cn' => "验证码错误",
    				'en' => "Wrong captcha",
    		],
    		'303'=>[
    				'cn' => "验证码已经过期",
    				'en' => "Expired captcha",
    		],
    		'304'=>[
    				'cn' => "该账号访问次数太频繁，请稍后再试",
    				'en' => "Too frequent attempts, please try later",
    
    		],
    		'305'=>[
    				'cn' => "短信黑名单",
    				'en' => "Not authorized SMS number",
    
    		],
    		'306'=>[
    				'cn' => "token不存在或者已经过期",
    				'en' => "Invalid Session id",
    
    		],
    		'307'=>[
    				'cn' => "请求验证码频繁，请稍后再试",
    				'en' => "Too frequent captcha requests, please try later",
    		],
    		'308'=>[
    				'cn' => "短信发送失败，请稍后重试",
    				'en' => "Failed to send SMS, please try later",
    		],
    		'309'=>[
    				'cn' => "未提供验证码",
    				'en' => "Please provide the captcha",
    		],
    		'310'=>[
    				'cn' => "未知验证码类型",
    				'en' => "Unknown captcha type",
    		],
    		'311'=>[
    				'cn' => "需要更换的手机号码已经注册",
    				'en' => "The phone number has already been registered, please use another one",
    		],
    		'312'=>[
    				'cn' => "密码为空或者密码存在不合法字符",
    				'en' => "Password is invalid, please check your input password.",
    		],
    		'313'=>[
    				'cn' => "请等待%d秒后重试",
    				'en' => "Please wait for %d seconds then retry",
    		],
    		'314'=>[
    				'cn' => "需要绑定的email已经存在",
    				'en' => "The email has already been registered, please bind another one",
    		],
    		'315'=>[
    				'cn' => "该账号已经绑定phone或email",
    				'en' => "The account has already bind phone or email",
    		],
    		'321'=>[
    				'cn' => "token不存在或者已经过期",
    				'en' => "Invalid token",
    		],
    		'322'=>[
    				'cn' => "token不合理的使用",
    				'en' => "Invalid token usage",
    		],
    		'323'=>[
    				'cn' => "生成token失败",
    				'en' => "Failed to generate token",
    		],
    		'324'=>[
    				'cn' => "发送邮件失败，请稍后再试",
    				'en' => "Failed to send email， please try it again later",
    		],
    		'331'=>[
    				'cn' => "第三方登录失败",
    				'en' => "Failed to login with third-party account",
    		],
    		'401'=>[
    				'cn' => "数据库访问失败",
    				'en' => "Internal error",
    		],
    		'100000' => [
    				'cn' => '服务器错误，请稍后重试',
    				'en' => 'Server error, please wait a minute and try it again'
    		],
    		'-1'=>[
    				'cn' => "未知错误",
    				'en' => "Unknown error.",
    		],
    ];
    
    private $mail_subject = [
    		'en' => [
    				'register' => "Mobvoi Developer Verify Email",
    				'reset_pwd' => "Mobvoi Developer: Reset Password"
    		],
    		'cn' => [
    				'register' => "问问开发平台验证邮件",
    				'reset_pwd' => "问问开发平台: 如何重置密码"
    		]
    ];
    
    private $mail_body = [
    		'en' => [
    				'register' => "Dear @name,\n<br />\n<br />\n<p>\n   Please click on the following link to verify your email address and complete your signup.\n</p>\n<p><a href=\"@url\">@url</a></p>\n<br />\n<p>\n    <i>Sincerely,<br />\n    Mobvoi Developer Platform\n    </i>\n</p>",
    				'reset_pwd' => "Dear @name,\n<br />\n<br />\n<p>\n   You have submitted a password reset request.<br />\n   If it wasn't you, please ignore this email and make sure you can still login to your account.<br />\n    If it was you, please click on the following link to set a new password.<br />\n</p>\n<p>\n   <a href=\"@url\">@url</a>.\n</p>\n<p>\n   <i>Sincerely,<br />\n    Mobvoi Developer Platform\n    </i>\n</p>"
    		],
    		'cn' => [
    				'register' => "你好 @name,\n<br />\n<br />\n<p>\n   点击下方链接验证您的邮箱, <a href=\"@url\">@url</a>.\n</p>\n<br />\n<p>\n   <i>问问开发者平台</i>\n</p>",
    				'reset_pwd' => "你好 @name,\n<br />\n<br />\n<p>\n   这是一封密码重置确认邮件.<br />\n   如果非本人操作请忽略.<br />\n</p>\n<p>\n   如果您需要重置您的密码请点击<a href=\"@url\">重置密码</a>.\n</p>\n<p>\n   <i>问问开发者平台</i>\n</p>"
    		]
    ];
    
    private $URLS = [
    		'bind_email' => 'http://mobvoi-account/bind/email/token?token=%s&email=%s&origin=developer.chumenwenwen.com',
    		'register' => 'http://mobvoi-account/register?account_type=email',
    		'get_userinfo_byemail' => 'http://mobvoi-account/account/info/email?email=%s&origin=developer.chumenwenwen.com',
    		'get_user_info' => "http://mobvoi-account/get_account_info?wwid=%s&origin=developer.chumenwenwen.com",
    		'send_mail' => "http://mobvoi-account/mail/mime?origin=developer.chumenwenwen.com",
    		'mail_token' => "http://mobvoi-account/mail/token?email=%s&usage=%s&origin=developer.chumenwenwen.com",
    		'mail_token_verify' => "http://mobvoi-account/mail/token/verify?token=%s&email=%s&usage=%s&origin=developer.chumenwenwen.com",
    		'sms_verify' => "http://mobvoi-account/captcha/sms/verify?phone=%s&captcha=%s&usage=%s&origin=developer.chumenwenwen.com",
    ];
    
    private $MAIL_LINK = [
    		'register' => 'verify link should be here',
    		'reset_pwd' => 'link to reset password page'
    ];
    
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
//         if (!Yii::$app->user->isGuest) {
//             return $this->goHome();
//         }
	
        $model = new LoginForm();
//         if ($model->load(Yii::$app->request->post()) && $model->login()) {
//             return $this->goBack();
//         } else {
//             return $this->render('login', [
//                 'model' => $model,
//             ]);
//         }
        
        $session = Yii::$app->session;
        $request = Yii::$app->request->post();
        
        if (!empty($session['user'])) {
        		return $this->goHome();
        }
        
        if (!empty($request['email']) && !empty($request['password'])) {
        	$url = "http://mobvoi-account/login?account_type=email";
        	$post_data = array(
        			"email" => $request['email'],
        			"password" => $request['password'],
        			"origin" => "developer.chumenwenwen.com",
        	);
        	
        	$post_data = json_encode($post_data);
        	$output = $this->http_post_data($url, $post_data);
        	
        	$output = json_decode($output);
        	
        	if ($output->err_code == 0) {
        		//生成用户session信息
        		$session->set('user', $output);
        		$msg['status'] = 'success';
        		$msg['msg'] = 'success';
        	} else {
        		$msg['status'] = 'error';
        		$msg['msg'] = $this->error_message[$output->err_code]['en'];
        	}
        	return json_encode($msg);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
        
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
		unset(Yii::$app->session['user']);
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
//         $model = new SignupForm();
//         if ($model->load(Yii::$app->request->post())) {
//             if ($user = $model->signup()) {
//                 if (Yii::$app->getUser()->login($user)) {
//                     return $this->goHome();
//                 }
//             }
//         }
		
        $request = Yii::$app->request->post();
        
        // if (!empty($request['username']) && !empty($request['email']) && !empty($request['password']) && !empty($request['language']))
        if (!empty($request['email']) && !empty($request['password']) && !empty($request['language'])) {
			$user = UserData::findOne(['email' => $request['email']]);
			if ($user != null) {
				$user->password_hash = $request['password'];
				$user->password_reset_token = $this->generateToken();
				$user->save(false);
				
// 				$msg['status'] = 'error';
// 				$msg['msg'] = "This email address already corresponds to a Mobvoi Account. Please sign in";
// 				return json_encode($msg);
			} else {
				$user = new UserData();
				//$user->username = $request['username'];
				$user->email = $request['email'];
				$user->password_hash = $request['password'];
				$user->password_reset_token = $this->generateToken();
				$user->status = -1;
				$user->created_at = time();
				$user->updated_at = time();
				$user->save(false);
			}
        	
        	
        	// TODO: 需要一个用户从邮箱点进去的页面，完成验证和注册到问问id
        	$verify_url = Url::to(['site/active-user', 'lang' => 'en', 'token' => $user->password_reset_token], true);
        	
        	
        	$mail_body = str_replace('@url', $verify_url,
        			str_replace('@name', $request['username'],
        					$this->mail_body['en']['register']));
        	
        	$response_str = $this->sendMail($request['email'], $this->mail_subject['en']['register'], $mail_body);
        	
        	
        	
        	$response = json_decode($response_str);
        	
        	if ($response->err_code == 0) {
        		$msg['status'] = 'success';
        		$msg['msg'] = 'Dear user, we give you an e-mail sent activation email, ';
        		$msg['msg'] .= 'please click on the activation link inside the email to activate your account';
        		return json_encode($msg);
        	} else {
        		return $response_str;
        	}
        	
        	
        } else {
        	return $this->render('signup');
        }
        
    }

    // send email to some one
    private function sendMail($to, $subject, $body) {
    	$post_body = json_encode(
    			array(
    					'to' => $to,
    					'subject' => $subject,
    					'body' => $body
    			)
    			);
    
    	$response_str = $this->http_post_data($this->URLS['send_mail'], $post_body);
    
    	$response = json_decode($response_str, true);
    
    	error_log('File: '. __FILE__ . ' line: ' . __LINE__ . 'sendMail response=' . $response_str);
    	if ($response['status'] !== 'success') {
    		error_log('File: '. __FILE__ . ' line: ' . __LINE__ . 'send mail failed, msg=' . $response['err_msg']);
    	}
    
    	return $response_str;
    }
    
    public function actionActiveUser($lang, $token)
    {
    	$session = Yii::$app->session;
    
    	if (!$lang) {
    		throw new InvalidParamException('Language is null.');
    	}
    
    	if (!static::isTokenValid($token)) {
    		throw new InvalidParamException('Wrong token.');
    	}
    
    	$user = UserData::findOne([
    			'password_reset_token' => $token,
    			'status' => -1,
    	]);
    
    	if (!$user) {
    		throw new InvalidParamException('Wrong token.');
    	}
    
    	$user_data = array(
    			"create_time" => date('Y-m-d H:i:s', time()),
    			"nick_name" => $user['username'],
    			"email" => $user['email'],
    			"password" => $user['password_hash'],
    			"origin" => "developer.chumenwenwen.com",
    	);
    
    
    	$user_data = json_encode($user_data);
    	$output = $this->http_post_data($this->URLS['register'], $user_data);
    
    	$output = json_decode($output);
    	// 		print_r($output);die();
    	if($output->err_code == 0) {
    		$url = "http://mobvoi-account/login?account_type=email";
    		$post_data = array(
    				"email" => $user['email'],
    				"password" => $user['password_hash'],
    				"origin" => "developer.chumenwenwen.com",
    		);
    			
    		$post_data = json_encode($post_data);
    		$user_info = $this->http_post_data($url, $post_data);
    			
    		$user_info = json_decode($user_info);
    		//生成用户session信息
    		$session->set('user', $user_info);
    			
    		//删除本地保存的用户信息
//     		$user->delete();
    			
    	}
    	unset($output->content);
    
    	// 		print_r($output);die;
    	$msg['err_code'] = $output->err_code;
    	$msg['status'] = $output->status;
    	$msg['msg'] = $this->error_message[$output->err_code][$lang];
    
    	return $this->render('activeuser', ['msg' =>$msg]);
    }
    
    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isTokenValid($token)
    {
    	if (empty($token)) {
    		return false;
    	}
    
    	$timestamp = (int) substr($token, strrpos($token, '_') + 1);
    	$expire = Yii::$app->params['user.passwordResetTokenExpire'];
    	return $timestamp + $expire >= time();
    }
    
    /**
     * Generates new password reset token
     */
    public function generateToken()
    {
    	return Yii::$app->security->generateRandomString() . '_' . time();
    }
    
    // get mail token
    // $usage = register/reset_pwd
    private  function getMailToken($email, $usage) {
        $response_str = $this->http_get_data(sprintf($this->URLS['mail_token'], $email, $usage));
        $response = json_decode($response_str,true);
        error_log('File: '. __FILE__ . ' line: ' . __LINE__ . 'getMailToken response='. $response_str);
        //         return $response;
        //         print_r($response);die();
        if ($response['status'] == 'success') {
            return $response['content']['value'];
        }
        error_log('File: '. __FILE__ . ' line: ' . __LINE__ . 'get mail token failed, err_msg=' . $response['err_msg']);
        return '';
    }
    
    // verify email token
    // $usage = register/reset_pwd
    private function verifyMailToken($token, $email, $usage) {
        $url = sprintf($this->URLS['mail_token_verify'], $token, $email, $usage);
        $response_str = $this->http_post_data($url);
    
        $response = json_decode($response_str);
    
        return $response;
    }
    
    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $request = Yii::$app->request->post();
        
        if (!empty($request['email']) && !empty($request['lang'])) {
            //检查用户是否存在
            $url = sprintf($this->URLS['get_userinfo_byemail'], $request['email']);
            $user_info_str = SiteController::http_get_data($url);
            $user_info = json_decode($user_info_str);
            if ($user_info->err_code != 0) {
                $msg['status'] = 'error';
				$msg['msg'] = $this->error_message['100'][$request['lang']];
				return json_encode($msg);
            }
            
            $username = empty($user_info->base_info->nickname) ? 'User' : $user_info->base_info->nickname;
            //如果用户存在
            // TODO: 需要一个用户从邮箱点进去的页面，完成验证和注册到问问id
            $verify_url = Url::to(['site/reset-password', 'lang'=>$request['lang'], 'email'=>$request['email'], 'token' => $this->getMailToken($request['email'], 'reset_pwd')], true);
            
            $mail_body = str_replace('@url', $verify_url,
                str_replace('@name', $username,
                    $this->mail_body['en']['reset_pwd']));
            
            $send_mail_result = $this->sendMail($request['email'], $this->mail_subject[$request['lang']]['reset_pwd'], $mail_body);
            
            $res = json_decode($send_mail_result);
//             print_r($res);die;
            if ($res->err_code == 0 ) {
				$msg['status'] = 'success';
				if ($request['lang'] == 'cn') {
					$msg['msg'] = '重置密码链接已发送至您的邮箱，请点击邮件内的重置密码链接重置您的密码。';
				} else if ($request['lang'] == 'en') {
					$msg['msg'] = 'A password reset link has been sent to your email. Please check your email and click the link to reset your password.';
				}
			} else {
				error_log('Line: '.__LINE__.'    File: '.__FILE__);
				error_log('send reset password email to '.$request['email'].'  failed.');
				$msg['status'] = 'error';
				if ($request['lang'] == 'cn') {
					$msg['msg'] = '发生了错误...';
				} else if ($request['lang'] == 'en') {
					$msg['msg'] = 'Sorry, we are unable to reset password for email provided.';
				}
			}
			return json_encode($msg);
            
            
        }

        return $this->render('requestPasswordResetToken');
    }

    
    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($lang, $email, $token)
    {
        $request = Yii::$app->request->post();
        
        if (!empty($request['password'])) {
            
            $response = $this->verifyMailToken($token, $email, 'reset_pwd');
            // 		print_r($response);
            if ($response->err_code != 0) {
                $msg['status'] = 'error';
                $msg['msg'] = 'Token is wrong!';
                return json_encode($msg);
            }
            
            //重置密码
            $url  = "http://mobvoi-account/reset_pwd?account_type=email";
            $data_array = [
                'need_captcha' => false,
                'origin' => "developer.chumenwenwen.com",
                'email' => $email,
                'new_password' => $request['password'],
            ];
            $data_string = json_encode($data_array);
            
            $output_str = $this->http_post_data($url, $data_string);
            
            $output = json_decode($output_str);
            if($output->err_code == 0) {
                $msg['status'] = 'success';
                if ($request['lang'] == 'cn') {
                    $msg['msg'] = '重置密码成功！';
                } else if ($request['lang'] == 'en') {
                    $msg['msg'] = 'Reset Password success.';
                }
                	
            } else {
                $msg['status'] = 'error';
                if ($request['lang'] == 'cn') {
                    $msg['msg'] = '发生了错误...';
                } else if ($request['lang'] == 'en') {
                    $msg['msg'] = 'Sorry, we are unable to reset password for email provided.';
                }
            }
            
            return json_encode($msg);
            
        }


        return $this->render('resetPassword',['email' => $email, 'token' => $token]);
    }
    
    /**
     * post
     *
     * @param string $url url
     * @param string $data_string json string
     * @return json
     */
    public static function http_post_data($url, $data_string='') {
    
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_POST, 1);
    	curl_setopt($ch, CURLOPT_URL, $url);
    
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    			'Content-Type: application/json; charset=utf-8',
    			'Content-Length: ' . strlen($data_string))
    			);
    
    	ob_start();
    	curl_exec($ch);
    	$return_content = ob_get_contents();
    	ob_end_clean();
    
    	if(curl_error($ch))
    	{
    		error_log('File: '. __FILE__ . ' line: ' . __LINE__ . ' Curl error: ' . curl_error($ch));
    	}
    
    	$return_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    	curl_close($ch);
    	return $return_content;
    }
    
    /**
     * get
     *
     * @param string $url url
     * @return json
     */
    public static function http_get_data($url) {
    
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $url);
    
    	ob_start();
    	curl_exec($ch);
    	$return_content = ob_get_contents();
    	ob_end_clean();
    
    	if(curl_error($ch))
    	{
    		error_log('File: '. __FILE__ . ' line: ' . __LINE__ . ' Curl error: ' . curl_error($ch));
    	}
    
    	$return_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    	curl_close($ch);
    	return $return_content;
    }
}

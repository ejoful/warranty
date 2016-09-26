<?php

namespace backend\controllers;

use Yii;
use backend\models\FormInfo;
use backend\models\FormInfoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * FormInfoController implements the CRUD actions for FormInfo model.
 */
class FormInfoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                        'class' => AccessControl::className(),
                        'rules' => [
                                [
                                        'actions' => ['login', 'error'],
                                        'allow' => true,
                                ],
                                [
                                        'allow' => true,
                                        'roles' => ['@'],
                                ],
                        ],
                ],
        ];
    }

    private $URLS = [
    		'send_mail' => "http://mobvoi-account/mail/mime?origin=warranty.ticwear.com",
    ];
    
    /**
     * Lists all FormInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FormInfoSearch();
        //让物流管理员只能看到审核管理员同意后的单子信息
        if(Yii::$app->user->identity->user_identity=="3"){
            $searchModel->status=4;
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FormInfo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new FormInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FormInfo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FormInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FormInfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionApprove()
    {
        $get = Yii::$app->request->get();

        $id = $get['id'];

    	$model = $this->findModel($id);
    
    	$model->status = 4;
    	
        $model->update_time = date('Y-m-d H:i:s', time());

        $model->reviewerid = Yii::$app->user->identity->id;

    	$model->save(false);

        $page = $get['page'];

        if($page=="view"){
            return $this->redirect(['view','id' => $id]);
        }
    	else{
            return $this->redirect(['index','id' => $id]);
        }
    }

    public function actionReject($id){

        $model = $this->findModel($id);

        $id = $model->id;

        $to = $model->email;

        $name = $model->consumer_name;

        return $this->render('reject_email',['to'=>$to,'name'=>$name,'id'=>$id]);

    }

    public function actionSend_reject()
    {
        $post = Yii::$app->request->post();

        $page = $post['page'];

        $id = $post['id'];

        $model = $this->findModel($id);
    
        $model->status = 5;

        $model->reviewerid = Yii::$app->user->identity->id;

        $model->save(false);
    	
    	//给用户发拒绝邮件
    	$email = $model->email;
    	
    	$subject = $get['content'];
    	
    	$mail_body = '<div><span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: small;">Dear @username,</span><br style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: small;"><br style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: small;"><span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: small;">We regret to inform you that you that we cannot approve you warranty.After checking the information you provided, we believe you are responsible for the damage of the product.</span><br style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: small;"><br style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: small;"><span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: small;">If you have any further questions, you can contact us by emailing support@</span><span class="J-JK9eJ-PJVNOc" data-g-spell-status="2" id=":114.2" tabindex="-1" role="menuitem" aria-haspopup="true" style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: small; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(255, 255, 255);">mobvoi</span><span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: small;">.com with your&nbsp;</span><span class="J-JK9eJ-PJVNOc" data-g-spell-status="2" id=":114.3" tabindex="-1" role="menuitem" aria-haspopup="true" style="font-family: arial, sans-serif; font-size: small; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(255, 255, 255);">RMA</span><span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: small;">&nbsp;number.</span><br style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: small;"><br style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: small;"><span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: small;">Thanks!</span><br style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: small;"><span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: small;">The&nbsp;</span><span class="J-JK9eJ-PJVNOc" data-g-spell-status="2" id=":114.4" tabindex="-1" role="menuitem" aria-haspopup="true" style="font-family: arial, sans-serif; font-size: small; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(255, 255, 255);">Ticwatch</span><span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: small;">&nbsp;Team</span></div>';
    	
    	$mail_body = str_replace('@username',$model->consumer_name, $mail_body);
    	
    	$send_mail_result = $this->sendMail($email, $subject, $mail_body);
    		
    	$res = json_decode($send_mail_result);
    		
    	if ($res->err_code != 0 ) {
    		$msg['status'] = 'error';
    		$msg['msg'] = '发生了错误...';
    		error_log('File: ' . __FILE__ . '   Line: ' . __LINE__ . ' Reject email send to ' . $model->email . ' fail.  form info id ' . $model->id);
    	}
    	// if($page=="view"){
     //        return $this->redirect(['view','id' => $id]);
     //    }
     //    else{
     //        return $this->redirect(['index','id' => $id]);
     //    }
    	// return $this->redirect(['index']);
        return "success";
    }

    public function actionInfo_request($id)
    {
    	$model = $this->findModel($id);
    
    	$model->status = 3;

        $model->reviewerid = Yii::$app->user->identity->id;
    
    	$model->save(false);
    
    	//给用户发请求更多信息邮件
    	$email = $model->email;
    	
    	$subject = "Ask for more information regarding your warranty claim";
    	
    	$mail_body = '<div><span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: small;">Dear @user,</span><br style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: small;"><br style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: small;"><span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: small;">We have received your warranty request but the information you have provided is not clear enough for us to make the decision. Kindly provide the following information:</span><div style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: small;"><br><div><span style="color: rgb(51, 51, 51); font-family: &quot;helvetica neue&quot;, helvetica, arial, sans-serif; font-size: 14px; font-weight: bold;">detailed description</span><br></div><div><span style="color: rgb(51, 51, 51); font-family: &quot;helvetica neue&quot;, helvetica, arial, sans-serif; font-size: 14px; font-weight: bold;">video&nbsp;<span class="J-JK9eJ-PJVNOc" data-g-spell-status="3" id=":114.14" tabindex="-1" role="menuitem" aria-haspopup="true">url</span></span><span style="color: rgb(0, 85, 170); font-family: monospace; font-size: 10.66px; background-color: rgb(229, 229, 229);"><br></span></div><div><span style="color: rgb(51, 51, 51); font-family: &quot;helvetica neue&quot;, helvetica, arial, sans-serif; font-size: 14px; font-weight: bold;">certificate</span><span style="color: rgb(0, 85, 170); font-family: monospace; font-size: 10.66px; background-color: rgb(229, 229, 229);"><br></span></div><div><span style="color: rgb(0, 85, 170); font-family: monospace; font-size: 10.66px; background-color: rgb(229, 229, 229);"><br></span></div><div>You can upload the above information here:</div><div><a href="@url" style="color: rgb(17, 85, 204);">Link to your warranty ticket</a><br><br>Thanks!<br>The&nbsp;<span class="J-JK9eJ-PJVNOc" data-g-spell-status="3" id=":114.15" tabindex="-1" role="menuitem" aria-haspopup="true">Ticwatch</span>&nbsp;Team</div></div></div>';
    	
    	$form_info_url = Yii::$app->urlManager->createUrl($params);
    	
    	$mail_body = str_replace('@user',$model->consumer_name, $mail_body);
    	$mail_body = str_replace('@url',$form_info_url, $mail_body);
    	
    	$send_mail_result = $this->sendMail($email, $subject, $mail_body);
    	
    	$res = json_decode($send_mail_result);
    	
    	if ($res->err_code != 0 ) {
    		$msg['status'] = 'error';
    		$msg['msg'] = '发生了错误...';
    		error_log('File: ' . __FILE__ . '   Line: ' . __LINE__ . ' Reject email send to ' . $model->email . ' fail.  form info id ' . $model->id);
    	}
        $get = Yii::$app->request->get();
        $page = $get['page'];
        
    	if($page=="view"){
            echo $page;
            return $this->redirect(['view','id' => $id]);
        }
        else{
            return $this->redirect(['index','id' => $id]);
        }
    }

    public function actionEmail_ship($id)
    {
        $model = $this->findModel($id);

        $model->reviewerid = Yii::$app->user->identity->id;

        $model->save(false);

        $to = $model->email;

        $name = $model->consumer_name;

        return $this->render('shipping',['to'=>$to,'name'=>$name]);
    }

    public function actionSend_email()
    {
        $get = Yii::$app->request->post();
        $to = $get['to'];
        $title = $get['title'];
        $content = $get['content'];
        $this->sendMail($to,$title,$content);
        return "sucess";
    }
    
    /**
     * Finds the FormInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FormInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FormInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
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
}

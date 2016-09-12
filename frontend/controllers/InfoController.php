<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\Fp;
use backend\models\Sp;
use backend\models\Check;
use backend\models\Country;
use backend\models\FormInfo;
/**
 * InfoController implements the CRUD actions for Info model.
 */
class InfoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
// 			'access' => [
// 					'class' => AccessControl::className(),
// 					'rules' => [
// 							[
// 									'allow' => true,
// 									'roles' => ['@'],
// 							],
// 					],
// 			],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Info models.
     * @return mixed
     */
    public function actionIndex()
    {
        $fp = Fp::find()
        ->orderBy('position')
        ->all();
        $country = Country::find()
        ->orderBy('position')
        ->all();
        return $this->render('index',['fp' => $fp,'country' => $country]);
    }

    public function actionSearch()
    {
        $post = Yii::$app->request->post();
        $fpid = $post['fpid'];
        $fp = fp::find()
        ->where(['id' => $fpid])
        ->one();
        $list="";
        if($fp->des=="Others"){
            return $list;
        }
        else{
            $Sp = Sp::find()
            ->where(['fpid' => $fpid])
            ->orderBy('position')
            ->all();
            foreach ($Sp as $sp) {
                $list.="<span class='list-span'><input type='radio' class='sp-btn' name='sp' value='".$sp->id."'>".$sp->des."</span>";
            }
            return $list;
        }
    }
    public function actionSelfCheck(){
        $post = Yii::$app->request->post();
        $spid = $post['spid'];
        $check = Check::find()
        ->where(['spid' => $spid])
        ->orderBy('position')
        ->all();
        $list = '';
        foreach ($check as $check) {
            $list.="<p>".$check->des."</p>";
        }
        return $list;
    }

    public function actionInfoInsert(){
        echo date('Y-m-d H:i:s', time());
        $model = new FormInfo();
        $post = Yii::$app->request->post();
        if($post['firstlevel_problem']){
            $model->firstlevel_problem = $post['firstlevel_problem'];
        }
        if($post['secondlevel_problem']){
            $model->secondlevel_problem = $post['secondlevel_problem'];
        }
        if($post['problem_des']){
            $model->problem_des = $post['problem_des'];
        }
        if($post['video']){
            $model->video = $post['video'];
        }
        $model->consumer_name = $post['consumer_name'];
        $model->watch_id = $post['watch_id'];
        $model->email = $post['email'];
        $model->consumer_phone = $post['consumer_phone'];
        $model->country = $post['country'];
        $model->address = $post['address'];
        $model->zip_code = $post['zip_code'];
        $model->certificate = $post['certificate'];
        $model->create_time = date('Y-m-d H:i:s', time());
        //$model->wwid = Yii::$app->session['user']->wwid;
        $model->wwid = 1;
        $model->save(false);
        return "success";
    }
    public function actionList(){
        return $this->render('list');
    }
}

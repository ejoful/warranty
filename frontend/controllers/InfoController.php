<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\Fp;
use backend\models\Sp;
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
			'access' => [
					'class' => AccessControl::className(),
					'rules' => [
							[
									'allow' => true,
									//'roles' => ['@'],
							],
					],
			],
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
        return $this->render('index',['fp' => $fp]);
    }

    public function actionSearch()
    {
        $post = Yii::$app->request->post();
        $fpid = $post['fpid'];
        $Sp = Sp::find()
        ->where(['fpid' => $fpid])
        ->orderBy('position')
        ->all();
        $list="";
        foreach ($Sp as $sp) {
            $list.="<span class='list-span'><input type='radio' class='sp-btn' name='sp' value='".$sp->id."'>".$sp->des."</span>";
        }
        return $list;
    }
}

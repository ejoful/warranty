<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\Lookup;
use backend\models\Sp;
use backend\models\Fp;
use backend\models\Country;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\FormInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Form Infos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Form Info'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
             'consumer_name',
//              'consumer_phone',
//              'email:email',
             'watch_id',
             //'status',
//              'create_time:datetime',
//              'update_time:datetime',
             [
                'attribute' => 'firstlevel_problem',
                'value'=> function ($model) {
                	return Fp::item($model->firstlevel_problem);
                },
                'filter'=>Fp::items(),
            ],
            [
                'attribute' => 'secondlevel_problem',
                'value'=> function ($model) {
                return Sp::item($model->firstlevel_problem,$model->secondlevel_problem);
                },
                'filter'=>Sp::items($searchModel->firstlevel_problem),
            ],
             'problem_des:ntext',
             'video',
             [
                'attribute' => 'country',
                'value'=> function ($model) {
                return Country::item($model->country);
                },
                'filter'=>Country::items(),
            ],
             'address',
             [
                'attribute' => 'status',
                'value'=> function ($model) {
                return Lookup::item('ReviewStatus',$model->status);
                },
                'filter'=>Lookup::items('ReviewStatus'),
            ],

            [
            		'class' => 'yii\grid\ActionColumn',
            		'header' => '操作',
            		'template' => '{audit}',
            		'buttons' => [
		            	'audit' => function ($url, $model, $key) {
		            		return $model->status == 'editable' ?
		            		Html::a('<span class="glyphicon glyphicon-user"></span>', $url, ['title' => '审核'] ) : '';
		            		},
	            	],
	            	'headerOptions' => ['width' => '80'],
	        ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

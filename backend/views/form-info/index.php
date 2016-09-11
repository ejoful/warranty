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

//             'id',
            'consumer_name',
//             'consumer_phone',
            'watch_id',
            'email:email',
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
			[
				'attribute' => 'country',
				'value'=> function ($model) {
					return Country::item($model->country);
				},
				'filter'=>Country::items(),
			],
			[
				'attribute' => 'status',
				'value'=> function ($model) {
					return Lookup::item('RMAStatus',$model->status);
				},
				'filter'=>Lookup::items('RMAStatus'),
			],
            // 'address',
            // 'zip_code',
            // 'certificate:ntext',
            // 'problem_des:ntext',
            // 'video',
            // 'create_time',
            // 'update_time',
            // 'wwid',
            // 'reviewerid',
            // 'logisid',

            [
	            'class' => 'yii\grid\ActionColumn',
	            'header' => '操作',
	            'template' => '{view} {update} {delete} {approve} {reject} {info_request}',
	            'buttons' => [
	            	'approve' => function ($url, $model, $key) {
	            	$options = array_merge([
	            			'title' => Yii::t('yii', '审核通过'),
	            			'aria-label' => Yii::t('yii', 'Approved'),
	            			'data-confirm' => Yii::t('yii', 'Logistics partner will send the customer with shipping label information.'),
	            			'data-method' => 'get',
	            			'data-pjax' => '0',
	            	]);
	            		return Html::a('<span class="btn btn-success btn-xs">Approve</span>', $url, $options );
					},
					'reject' => function ($url, $model, $key) {
						return Html::a('<span class="btn btn-warning btn-xs">Reject</span>', $url, ['title' => '拒绝'] );
					},
					'info_request' => function ($url, $model, $key) {
						return Html::a('<span class="btn btn-info btn-xs">Info Request</span>', $url, ['title' => '请求获得更多信息'] );
					},
	            ],
	            'headerOptions' => ['width' => '80'],
           ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

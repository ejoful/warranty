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
					return Lookup::item('ReviewStatus',$model->status);
				},
				'filter'=>Lookup::items('ReviewStatus'),
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use frontend\assets\AppAsset;
use frontend\models\FormInfo;
use backend\models\Lookup;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\FormInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

AppAsset::addCss($this,"@web/css/history.css");

$this->title = Yii::t('app', 'my history');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-info-index">

    <!-- <h1><//?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!-- <p>
        <//?= Html::a(Yii::t('app', 'Create Form Info'), ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'consumer_name',
            'watch_id',
            'consumer_phone',
            'email:email',
            //'country',
            //'address',
            //'zip_code',
            //'firstlevel_problem',
            //'secondlevel_problem',
            //'certificate:ntext',
            //'problem_des:html',
            [
                'attribute' => 'problem_des',
                'value'=> function ($model) {
                    return FormInfo::item($model->id);
                },
            ],
            //'video',
            'create_time',
            'update_time',
            //'wwid',
            //'reviewerid',
            //'logisid',
            //'status',
            [
                'attribute' => 'status',
                'value'=> function ($model) {
                    return Lookup::item('ReviewStatus',$model->status);
                },
                'filter'=>Lookup::items('ReviewStatus'),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

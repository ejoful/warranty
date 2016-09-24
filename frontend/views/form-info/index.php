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
                'format' => 'html',
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
                    return Lookup::item('RMAStatus',$model->status);
                },
                'filter'=>Lookup::items('RMAStatus'),
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' =>[
                    'update' => function($url, $model, $key) {
                        if ($model->status!=4) {
                             $options = array_merge([
                                    'title' => Yii::t('yii', 'Update'),
                            ]);
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options );
                        }
                    },
                    'delete' => function($url, $model, $key) {
                        if ($model->status!=4) {
                            $options = array_merge([
                                    'title' => Yii::t('yii', 'Delete'),
                            ]);
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, $options );
                        }
                    },
                ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

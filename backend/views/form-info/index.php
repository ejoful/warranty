<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\Lookup;
use backend\models\Sp;
use backend\models\Fp;
use backend\models\Country;
use dosamigos\tableexport\ButtonTableExport;
use dosamigos\tableexport\ButtonTableExportAsset;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\FormInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
ButtonTableExportAsset::register($this);
$this->title = Yii::t('app', 'Form Infos');
$this->params['breadcrumbs'][] = $this->title;
?>
<a id="linkId">Export Table as Xml</a>
<div class="form-info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!-- <p>
        <?//= Html::a(Yii::t('app', 'Create Form Info'), ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->
<?php Pjax::begin(); ?>
<?= ButtonTableExport::widget(
    [
        'label' => 'Export Table',
        'selector' => '#examine',
        'exportClientOptions' => [
            'ignoredColumns' => [10, 11],
            'useDataUri' => false,
            'url' => \yii\helpers\Url::to('controller/download')
        ]
    ]
);?>
<?php 
    $user_identity = Yii::$app->user->identity->user_identity;
    if($user_identity == "审核管理员"){
        echo GridView::widget([
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
            'email_trace:email',
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
                        if ($model->status != 4 && $model->status != 6) {
                            $options = array_merge([
                                    'title' => Yii::t('yii', '审核通过'),
                                    'aria-label' => Yii::t('yii', 'Approved'),
                                    'data-confirm' => Yii::t('yii', 'Logistics partner will send the customer with shipping label information.'),
                                    'data-method' => 'get',
                                    'data-pjax' => '0',
                            ]);
                            return Html::a('<span class="btn btn-success btn-xs">Approve</span>', $url, $options );
                        } else {
                            return '';
                        }
                    
                    },
                    'reject' => function ($url, $model, $key) {
                        if ($model->status != 5 && $model->status != 6) {
                            $options = array_merge([
                                    'title' => Yii::t('yii', '拒绝'),
                                    'aria-label' => Yii::t('yii', 'Reject'),
                                    //'data-confirm' => Yii::t('yii', 'Systemt will send the customer with Reject label information.'),
                                    'data-method' => 'get',
                                    'data-pjax' => '0',
                            ]);
//                      return Html::a('<span class="btn btn-warning btn-xs">Reject</span>', $url, ['title' => '拒绝'];
                            return Html::a('<span class="btn btn-warning btn-xs">Reject</span>', $url, $options );
                        } else {
                            return '';
                        }
                    },
                    'info_request' => function ($url, $model, $key) {
                        $options = array_merge([
                                'title' => Yii::t('yii', '请求获得更多信息'),
                                'aria-label' => Yii::t('yii', 'Info Request'),
                                'data-method' => 'get',
                                'data-pjax' => '0',
                                'data-confirm' => Yii::t('yii','Send a message to the user for more information.'),
                        ]);
                        return Html::a('<span class="btn btn-info btn-xs">Info Request</span>', $url, $options );
                    },
                ],
                'headerOptions' => ['width' => '80'],
           ],
        ],
    ]); }
    else if($user_identity == "物流管理员"){
        echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'consumer_name',
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
            'address',
            'update_time',
            'email_trace:email',
           [
           'class' => 'yii\grid\ActionColumn',
           'header' => '操作',
           'template' => '{email_ship}',
           'buttons' => [
                'email_ship' => function ($url, $model, $key) {
                    if ($model->status == 4) {
                        $options = array_merge([
                                'title' => Yii::t('yii', 'Email shiping label'),
                                'aria-label' => Yii::t('yii', 'Email shiping label'),
                                'data-method' => 'get',
                                'data-pjax' => '0',
                        ]);
                        return Html::a('<span class="btn btn-success btn-xs">Email shiping label</span>', $url, $options );
                    } else {
                        return '';
                    }
                },
           ],
            'headerOptions' => ['width' => '80'],
         ],
        ],
    ]);
    }
    else if($user_identity == "管理员"){
        echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'consumer_name',
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
            'email_trace:email',
            [
                'attribute' => 'status',
                'value'=> function ($model) {
                    return Lookup::item('RMAStatus',$model->status);
                },
                'filter'=>Lookup::items('RMAStatus'),
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{view} {update} {delete} {approve} {reject} {info_request}',
                'buttons' => [
                    'approve' => function ($url, $model, $key) {
                        if ($model->status != 4 && $model->status != 6) {
                            $options = array_merge([
                                    'title' => Yii::t('yii', '审核通过'),
                                    'aria-label' => Yii::t('yii', 'Approved'),
                                    'data-confirm' => Yii::t('yii', 'Logistics partner will send the customer with shipping label information.'),
                                    'data-method' => 'get',
                                    'data-pjax' => '0',
                            ]);
                            return Html::a('<span class="btn btn-success btn-xs">Approve</span>', $url, $options );
                        } else {
                            return '';
                        }
                    },
                    'reject' => function ($url, $model, $key) {
                        if ($model->status != 5 && $model->status != 6) {
                            $options = array_merge([
                                    'title' => Yii::t('yii', '拒绝'),
                                    'aria-label' => Yii::t('yii', 'Reject'),
                                    'data-method' => 'get',
                                    'data-pjax' => '0',
                            ]);
                            return Html::a('<span class="btn btn-warning btn-xs">Reject</span>', $url, $options );
                        } else {
                            return '';
                        }
                        
                    },
                    'info_request' => function ($url, $model, $key) {
                        $options = array_merge([
                                'title' => Yii::t('yii', '请求获得更多信息'),
                                'aria-label' => Yii::t('yii', 'Info Request'),
                                'data-method' => 'get',
                                'data-pjax' => '0',
                                'data-confirm' => Yii::t('yii','Send a message to the user for more information.'),
                        ]);
                        return Html::a('<span class="btn btn-info btn-xs">Info Request</span>', $url, $options );
                    },
                ],
                'headerOptions' => ['width' => '80'],
           ],
           [
           'class' => 'yii\grid\ActionColumn',
           'header' => '操作',
           'template' => '{email_ship}',
           'buttons' => [
                'email_ship' => function ($url, $model, $key) {
                    if ($model->status == 4) {
                        $options = array_merge([
                                'title' => Yii::t('yii', 'Email shiping label'),
                                'aria-label' => Yii::t('yii', 'Email shiping label'),
                                'data-method' => 'get',
                                'data-pjax' => '0',
                        ]);
                        return Html::a('<span class="btn btn-success btn-xs">Email shiping label</span>', $url, $options );
                    } else {
                        return '';
                    }
                },
           ],
            'headerOptions' => ['width' => '80'],
         ],
        ],
    ]);
    }
    ?>
<?php Pjax::end(); ?></div>
<script type="text/javascript">
    $('#linkId').on('click', function() {
        $('table').tableExport({
        type: "csv",
        useDataUri: true
    });
});
</script>
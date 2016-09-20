<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\assets\AppAsset;
use backend\models\Sp;
use backend\models\Fp;
use backend\models\Lookup;
AppAsset::addCss($this,"@web/css/info.css");
/* @var $this yii\web\View */
/* @var $model backend\models\FormInfo */

$this->title = Yii::t('app', 'warranty service');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Form Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-info-view">

    <!-- <h1><?//= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>

        <?php 
            if ($model->status != 4 && $model->status != 6) {
              echo Html::a(Yii::t('app', 'Approve'), ['approve', 'id' => $model->id,'page' => 'view'], [
                'class' => 'btn btn-success btn-xs',
                'title' => Yii::t('yii', '审核通过'),
                'data' => [
                    'confirm' => Yii::t('app', 'Logistics partner will send the customer with shipping label information.'),
                    'method' => 'post',
                ],
            ]); 
        }
        ?>

        <?php
            if ($model->status != 5 && $model->status != 6){
               echo Html::a(Yii::t('app', 'Reject'), ['reject', 'id' => $model->id,'page' => 'view'], [
                'class' => 'btn btn-warning btn-xs',
                'title' => Yii::t('yii', '拒绝'),
                ]);
            }
            ?>

        <?= Html::a(Yii::t('app', 'Info Request'), ['info_request', 'id' => $model->id,'page' => 'view'], [
            'class' => 'btn btn-info btn-xs',
            'title' => Yii::t('yii', '请求获得更多信息'),
            'data' => [
                    'confirm' => Yii::t('yii','Send a message to the user for more information.'),
                    'method' => 'post',
                ],
            ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'consumer_name',
            'consumer_phone',
            'watch_id',
            'email:email',
            'country',
            'address',
            'zip_code',
            [
                'attribute' => 'firstlevel_problem',
                'value' => Fp::item($model->firstlevel_problem),
            ],
             [
                'attribute' => 'secondlevel_problem',
                'value' => Sp::item($model->firstlevel_problem,$model->secondlevel_problem),
            ],
            'certificate:html',
            'problem_des:html',
            'video',
            'create_time',
            [
                'attribute' => 'status',
                'value' => Lookup::item('RMAStatus',$model->status),
            ],
            'email_trace:email',
            'update_time',
            'wwid',
            'reviewerid',
            'logisid',
        ],
    ]) ?>

</div>
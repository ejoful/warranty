<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Country;
use backend\models\Fp;
use backend\models\Sp;
use backend\models\Lookup;

/* @var $this yii\web\View */
/* @var $model backend\models\FormInfo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Form Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-info-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
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
            [
                'attribute' => 'country',
                'value' => Country::item($model->country),
            ],
            'address',
            [
                'attribute' => 'firstlevel_problem',
                'value' => Fp::item($model->firstlevel_problem),
            ],
            [
                'attribute' => 'secondlevel_problem',
                'value' => Sp::item($model->firstlevel_problem,$model->secondlevel_problem),
            ],
            'problem_des:ntext',
            'video',
            'create_time',
            'update_time',
            [
                'attribute' => 'status',
                'value' => Lookup::item('ReviewStatus',$model->status),
            ],
        ],
    ]) ?>

</div>

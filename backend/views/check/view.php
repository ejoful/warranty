<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Sp;
use backend\models\Fp;

/* @var $this yii\web\View */
/* @var $model backend\models\Check */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Checks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="check-view">

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
            //'fpid',
            [
                'attribute' => 'fpid',
                'value'=> Fp::item($model->fpid),
            ],
            [
                'attribute' => 'spid',
                'value'=> Sp::item($model->fpid,$model->spid),
            ],
            //'spid',
            'des:ntext',
            'yes', 
            'no', 
            'position',
        ],
    ]) ?>

</div>

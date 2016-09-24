<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\Fp;
use backend\models\Sp;
use frontend\assets\AppAsset;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CheckSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '问题检查表');
$this->params['breadcrumbs'][] = $this->title;

AppAsset::addCss($this,"@web/css/check.css"); 
?>
<div class="check-index">

    <h1></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Check'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'fpid',
                'value' => function ($model){
                    return Fp::item($model->fpid);
                },
                'filter'=>Fp::items(),
            ],
            //'fpid',
            [
                'attribute' => 'spid',
                'value' => function ($model){
                    return Sp::item($model->fpid,$model->spid);
                },
                'filter'=>Sp::items($searchModel->fpid),
            ],
            //'spid',
            'des:ntext',
            'yes', 
            'no', 
            'position',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

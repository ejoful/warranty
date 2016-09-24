<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\Fp;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\SpSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '二级问题表');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sp-index">

    <h1></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Sp'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            // 'fpid',
            [
                'attribute' => 'fpid',
                'value' => function ($model){
                    return Fp::item($model->fpid);
                },
                'filter'=>Fp::items(),
            ],
            'des',
            'position',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

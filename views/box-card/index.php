<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BoxCardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $boxId integer */

$this->title = 'Box Cards';
$this->params['breadcrumbs'][] = ['label' => 'Boxes', 'url' => ['box/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box-card-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <p>
        <?= Html::a('Create Box Card', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'title',
            'sku',
            'shipped_qty',
            'received_qty',
            'price',
            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function ($action, $model, $key, $index){
                    // Add boxId to the URL parameters for each action
                    return [$action, 'id' => $model->id];
                }
            ],
        ],
    ]); ?>

</div>

<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BoxSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список коробок';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать коробку', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Отчет', ['export'], ['class' => 'btn btn-info']) ?> <!-- Кнопка для экспорта в Excel -->
    </p>
    <?= Html::beginForm(['box/update-status-multiple'], 'post') ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' => function ($model, $key, $index, $column) {
                    return ['value' => $model->id];
                }
            ],
            'reference',
            [
                'attribute' => 'created_at',
                'format' => ['datetime'],
                'label' => 'Дата',
                'enableSorting' => true,
            ],
            [
                'attribute' => 'weight',
                'format' => 'raw',
                'label' => 'Вес',
                'value' => function ($model) {
                    return Html::beginForm(['box/update-weight', 'id' => $model->id], 'post')
                        . Html::textInput('weight', $model->weight, ['class' => 'form-control', 'required' => true])
                        . Html::endForm();
                },
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'label' => 'Статус',
                'value' => function ($model) {
                    return Html::beginForm(['box/update-status', 'id' => $model->id], 'post')
                        . Html::dropDownList('status', $model->status, [
                            'Expected' => 'Expected',
                            'At warehouse' => 'At warehouse',
                        ], ['class' => 'form-control', 'required' => true])
                        . Html::endForm();
                },
                'enableSorting' => true,
            ],
            [
                'attribute' => 'shipped_qty',
                'label' => 'Shipped Qty',
                'value' => function ($model) {
                    return array_sum(ArrayHelper::getColumn($model->boxCards, 'shipped_qty'));
                },
            ],
            [
                'attribute' => 'received_qty',
                'label' => 'Received Qty',
                'value' => function ($model) {
                    return array_sum(ArrayHelper::getColumn($model->boxCards, 'received_qty'));
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        $shipped_qty_sum = array_sum(ArrayHelper::getColumn($model->boxCards, 'shipped_qty'));
                        $received_qty_sum = array_sum(ArrayHelper::getColumn($model->boxCards, 'received_qty'));
                        $color = ($shipped_qty_sum != $received_qty_sum) ? 'background-color: #ffcccb;' : '';
                        return Html::a('Карточка товара', ['box-card/index', 'boxId' => $model->id], ['class' => 'btn btn-info', 'style' => $color]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('Редактировать', ['box/update', 'id' => $model->id], ['class' => 'btn btn-primary']);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('Удалить', ['box/delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Вы уверены, что хотите удалить эту коробку?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>



    <div class="box-search">
        <?php $form = ActiveForm::begin([
            'method' => 'get',
            'action' => ['index'],
        ]); ?>

        <div class="row">
            <div class="col-md-3">
                <?= $form->field($searchModel, 'dateFrom')->input('date') ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($searchModel, 'dateTo')->input('date') ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($searchModel, 'searchTerm')->textInput(['placeholder' => 'Поиск по ID и reference']) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($searchModel, 'status')->dropDownList([
                    '' => 'Все',
                    'Expected' => 'Expected',
                    'At warehouse' => 'At warehouse',
                ]) ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Фильтровать', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Сбросить', ['index'], ['class' => 'btn btn-default']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-3">
                <?= Html::dropDownList('status', null, [
                    'Expected' => 'Expected',
                    'At warehouse' => 'At warehouse',
                ], ['prompt' => 'Выберите статус', 'class' => 'form-control', 'multiple'=> true]) ?>
            </div>
            <div class="col-md-3">
                <?= Html::submitButton('Сменить статус', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>

        <?php
        Html::endForm();

        ?>
    </div>

<!--    --><?php //= GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'columns' => [
//            [
//                'class' => 'yii\grid\CheckboxColumn',
//
//            ],            [
//                'attribute' => 'created_at',
//                'format' => ['datetime'],
//                'label' => 'Дата',
//                'enableSorting' => true,
//            ],
//            [
//                'attribute' => 'weight',
//                'format' => 'raw',
//                'label' => 'Вес',
//                'value' => function ($model) {
//                    return Html::beginForm(['box/update-weight', 'id' => $model->id], 'post')
//                        . Html::textInput('weight', $model->weight, ['class' => 'form-control', 'required' => true])
//                        . Html::endForm();
//                },
//            ],
//            [
//                'attribute' => 'status',
//                'format' => 'raw',
//                'label' => 'Статус',
//                'value' => function ($model) {
//                    return Html::beginForm(['box/update-status', 'id' => $model->id], 'post')
//                        . Html::dropDownList('status', $model->status, [
//                            'Expected' => 'Expected',
//                            'At warehouse' => 'At warehouse',
//                        ], ['class' => 'form-control', 'required' => true])
//                        . Html::endForm();
//                },
//                'enableSorting' => true,
//            ],
//            [
//                'class' => 'yii\grid\ActionColumn',
//                'template' => '{view} {update} {delete}',
//                'buttons' => [
//                    'view' => function ($url, $model) {
//                        return Html::a('Карточка товара', ['box-card/index', 'boxId' => $model->id], ['class' => 'btn btn-info']);
//                    },
//                    'update' => function ($url, $model) {
//                        return Html::a('Редактировать', ['box/update', 'id' => $model->id], ['class' => 'btn btn-primary']);
//                    },
//                    'delete' => function ($url, $model) {
//                        return Html::a('Удалить', ['box/delete', 'id' => $model->id], [
//                            'class' => 'btn btn-danger',
//                            'data' => [
//                                'confirm' => 'Вы уверены, что хотите удалить эту коробку?',
//                                'method' => 'post',
//                            ],
//                        ]);
//                    },
//                ],
//            ],
//        ],
//    ]);
    ?>
</div>

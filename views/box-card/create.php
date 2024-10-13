<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\BoxCard */
/* @var $form yii\widgets\ActiveForm */
/* @var $boxItems array */  // List of boxes

$this->title = 'Create Box Card';
$this->params['breadcrumbs'][] = ['label' => 'Box Cards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box-card-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="box-card-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'shipped_qty')->textInput() ?>

        <?= $form->field($model, 'received_qty')->textInput() ?>

        <?= $form->field($model, 'price')->textInput() ?>

        <?= $form->field($model, 'box_id')->dropDownList(
            $boxItems,
            ['prompt' => 'Select a Box']
        ) ?>

        <div class="form-group">
            <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
            <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-secondary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>

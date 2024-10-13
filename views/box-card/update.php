<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BoxCard */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Update Box Card: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Box Cards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box-card-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="box-card-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'shipped_qty')->textInput() ?>

        <?= $form->field($model, 'received_qty')->textInput() ?>

        <?= $form->field($model, 'price')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-secondary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>

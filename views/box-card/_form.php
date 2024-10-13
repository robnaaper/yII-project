<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BoxCard */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box-card-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput() ?>
    <?= $form->field($model, 'sku')->textInput() ?>
    <?= $form->field($model, 'shipped_qty')->textInput(['type' => 'number']) ?>
    <?= $form->field($model, 'received_qty')->textInput(['type' => 'number']) ?>
    <?= $form->field($model, 'price')->textInput(['type' => 'number', 'step' => '0.01']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

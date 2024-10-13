<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Box */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'weight')->textInput(['type' => 'number', 'step' => '0.01']) ?>
    <?= $form->field($model, 'width')->textInput(['type' => 'number', 'step' => '0.01']) ?>
    <?= $form->field($model, 'length')->textInput(['type' => 'number', 'step' => '0.01']) ?>
    <?= $form->field($model, 'height')->textInput(['type' => 'number', 'step' => '0.01']) ?>
    <?= $form->field($model, 'reference')->textInput() ?>

    <?php if (!$model->isNewRecord): ?>
        <?= $form->field($model, 'status')->dropDownList([
            'Prepared' => 'Prepared',
            'Shipped' => 'Shipped',
        ]) ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

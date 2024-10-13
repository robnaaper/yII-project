<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Box */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Update Box: ' . $model->reference;
$this->params['breadcrumbs'][] = ['label' => 'Boxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="box-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'reference')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'weight')->textInput() ?>

        <?= $form->field($model, 'width')->textInput() ?>

        <?= $form->field($model, 'length')->textInput() ?>

        <?= $form->field($model, 'height')->textInput() ?>

        <?= $form->field($model, 'status')->dropDownList([0 => 'Inactive', 1 => 'Active'], ['prompt' => 'Select Status']) ?>

        <div class="form-group">
            <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-secondary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Box */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Create Box';
$this->params['breadcrumbs'][] = ['label' => 'Boxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="box-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'reference')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'weight')->textInput() ?>

        <?= $form->field($model, 'width')->textInput() ?>

        <?= $form->field($model, 'length')->textInput() ?>

        <?= $form->field($model, 'height')->textInput() ?>

        <?= $form->field($model, 'status')->dropDownList([
            'Expected' => 'Expected',
            'Shipped' => 'Shipped',
            'Delivered' => 'Delivered',
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>

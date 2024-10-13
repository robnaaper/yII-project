<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Box */

$this->title = 'Delete Box: ' . $model->reference;
$this->params['breadcrumbs'][] = ['label' => 'Boxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box-delete">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Are you sure you want to delete this box?
    </p>

    <div class="alert alert-danger">
        <strong>Warning!</strong> This action cannot be undone.
    </div>

    <div class="form-group">
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-secondary']) ?>
    </div>

</div>

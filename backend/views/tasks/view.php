<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

\yii\web\YiiAsset::register($this);
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                Задача - <?= $model->name?>
            </h1>
        </div><!-- /.col -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="tasks-view">

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            [
                'attribute' => 'content',
                'value'=> function ($model) {
                    return $model->content;
                },
                'format'=>'raw',
            ],
            'priority',
            [
                'attribute' => 'performer_id',
                'value'=> function ($model) {
                    return $model->getPerformer()->one()->username;
                },
                'format'=>'raw',
            ],
            [
                'attribute' => 'author_id',
                'value'=> function ($model) {
                    return $model->getAuthor()->one()->username;
                },
                'format'=>'raw',
            ],
            [
                'attribute' => 'status_id',
                'value'=> function ($model) {
                    return $model->getStatusBadge($model->getStatus()->one()->name);
                },
                'format'=>'raw',
            ],
            [
                'attribute' => 'viewed',
                'value'=> function ($model) {
                    return $model->viewed ? "Да" : "Нет";
                },
                'format'=>'raw',
            ],
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

?>
<div class="status-index">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    Статусы
                </h1>
            </div><!-- /.col -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <p>
        <?= Html::a('Создать статус', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header' => "№"
            ],

            [
                'attribute' => 'name',
                'value' => function ($model) {
                    return Html::a(
                        $model->name,
                        ['view', 'id' => $model->id]
                    );
                },
                'format' => 'raw',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<i class="far fa-eye"></i>', $url, [
                            'class' => 'btn btn-default btn-xs custom_button'
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<i class="fas fa-pen"></i>', $url, [
                            'class' => 'btn btn-default btn-xs custom_button'
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return  Html::a('<i class="fas fa-trash"></i>', $url, [
                            'class' => 'btn btn-default btn-xs custom_button'
                        ]);
                    }
                ],
            ],
        ],
    ]); ?>

</div>

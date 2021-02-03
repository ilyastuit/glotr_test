<?php

use vova07\imperavi\Widget;
use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>
<div class="tasks-update">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    Обновить задачу - <?= $model->name?>
                </h1>
            </div><!-- /.col -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="tasks-create">

        <div class="tasks-form">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'content')->widget(Widget::className(), [
                'settings' => [
                    'lang' => 'ru',
                    'minHeight' => 200,
                    'plugins' => [
                        'clips',
                        'fullscreen',
                    ],
                    'clips' => [
                        ['Lorem ipsum...', 'Lorem...'],
                        ['red', '<span class="label-red">red</span>'],
                        ['green', '<span class="label-green">green</span>'],
                        ['blue', '<span class="label-blue">blue</span>'],
                    ],
                ],
            ]) ?>

            <?= $form->field($model, 'priority')->dropDownList(
            [
                1 => 1,
                2 => 2,
                3 => 3,
                4 => 4,
                5 => 5,
                6 => 6,
                7 => 7,
                8 => 8,
                9 => 9,
                10 => 10,
            ],
            [
                'prompt' => 'Выберите приоритет...'
            ]) ?>

            <?= $form->field($model, 'performer_id')->dropDownList(
                $users,
                [
                    'prompt' => 'Выберите исполнителя...'
                ]) ?>

            <?= $form->field($model, 'status_id')->dropDownList(
                $statutes,
                [
                    'prompt' => 'Выберите статус...'
                ]) ?>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>

    </div>

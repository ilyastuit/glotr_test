<?php

namespace backend\controllers;

use common\models\Status;
use common\models\TasksSearch;
use common\models\User;
use Yii;
use common\models\Tasks;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TasksController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new TasksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $statuses = ArrayHelper::map(
            Status::find()->all(),
            'id',
            'name'
        );
        $users = ArrayHelper::map(
            User::find()->all(),
            'id',
            'username'
        );

        // Prioritetni bazada otdelno tablica qilib ishlasj kerak, hozircha static
        $priorities = [
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
        ];

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'statuses' => $statuses,
            'users' => $users,
            'priorities' => $priorities,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Tasks();
        $users = ArrayHelper::map(
            User::find()->all(),
            'id',
            'username'
        );
        $statutes = ArrayHelper::map(
            Status::find()->all(),
            'id',
            'name'
        );
        if ($model->load(Yii::$app->request->post())) {
            $model->author_id = Yii::$app->user->identity->getId();
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'users' => $users,
            'statutes' => $statutes,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $users = ArrayHelper::map(
            User::find()->all(),
            'id',
            'username'
        );
        $statutes = ArrayHelper::map(
            Status::find()->all(),
            'id',
            'name'
        );
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'users' => $users,
            'statutes' => $statutes,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

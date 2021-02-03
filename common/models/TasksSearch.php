<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class TasksSearch extends Tasks
{
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['priority', 'performer_id', 'status_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            ['viewed', 'boolean']
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Tasks::find();
        $query->where(['performer_id' => Yii::$app->user->identity->getId()]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'status_id' => $this->status_id,
            'priority' => $this->priority,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
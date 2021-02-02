<?php

namespace common\models;

class Tasks extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'tasks';
    }

    public function rules()
    {
        return [
            [['name', 'performer_id', 'author_id', 'status_id', 'priority'], 'required'],
            [['content'], 'string'],
            [['performer_id', 'author_id', 'status_id'], 'default', 'value' => null],
            [['priority', 'performer_id', 'author_id', 'status_id'], 'integer'],
            [['viewed'], 'boolean'],
            [['name'], 'string', 'max' => 100],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['performer_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['performer_id' => 'id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'content' => 'Описание',
            'priority' => 'Приоритет',
            'performer_id' => 'Исполнитель',
            'author_id' => 'Назначитель',
            'status_id' => 'Статус',
            'viewed' => 'Просмотрено',
        ];
    }

    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    public function getPerformer()
    {
        return $this->hasOne(User::className(), ['id' => 'performer_id']);
    }

    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    public function getStatusBadge(String $name) {
        if ($name === "Новый")
            return '<span class="badge badge-danger">'. $name .'</span>';
        else if ($name === "В процессе")
            return '<span class="badge badge-info">'. $name .'</span>';
        else
            return '<span class="badge badge-success">'. $name .'</span>';
    }
}

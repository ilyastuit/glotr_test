<?php

namespace common\models;

use Yii;

class Status extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'status';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['status_id' => 'id']);
    }
}

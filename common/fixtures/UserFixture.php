<?php
namespace common\fixtures;

use yii\test\ActiveFixture;

class UserFixture extends ActiveFixture
{
    public $dataFile = '@common/tests/_data/user.php';
    public $modelClass = 'common\models\User';
}
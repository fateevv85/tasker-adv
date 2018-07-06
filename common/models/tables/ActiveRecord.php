<?php

namespace common\models\tables;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class ActiveRecord extends \yii\db\ActiveRecord
{
    //behavior for tables/models
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()')
            ]
        ];
    }
}

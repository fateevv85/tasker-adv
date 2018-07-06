<?php

namespace frontend\models;


use yii\base\Model;

class Test extends Model
{
    public $a;
    public $b;

    public function sum()
    {
        return $this->a + $this->b;
    }

    public function mul()
    {
        return $this->a * $this->b;
    }
}
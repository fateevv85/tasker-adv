<?php

namespace frontend\controllers;

use yii\web\Controller;

class PjaxController extends Controller
{
    public function actionTime()
    {
        $time = date('H:i:s');
        return $this->render('time', [
            'time' => $time
        ]);
    }

    public function actionRefresh()
    {
        $time = date('H:i:s');
        return $this->render('refresh', [
            'time' => $time
        ]);
    }
}
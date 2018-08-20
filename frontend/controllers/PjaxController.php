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

    public function actionHours()
    {
        $time = date('H:i:s');
        return $this->render('date', [
            'time' => $time
        ]);
    }

    public function actionMinutes()
    {
        $time = date('i:s');
        return $this->render('date', [
            'time' => $time
        ]);
    }

    public function actionMultiple()
    {
        $time = date('H:i:s');
        $hash = md5($time);
        return $this->render('multiple', [
            'time' => $time,
            'hash' => $hash
        ]);
    }

    public function actionForm()
    {
        $hash = '';
        if ($string = \Yii::$app->request->post('string')) {
            $hash = md5($string);
        }

        return $this->render('form', [
            'hash' => $hash
        ]);
    }

}
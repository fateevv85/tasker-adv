<?php

namespace frontend\controllers;

use SonkoDmitry\Yii\TelegramBot\Component;
use yii\helpers\Url;
use yii\web\Controller;

class TelegramController extends Controller
{
    public function actionReceive()
    {
        /** @var Component $bot */
        $bot = \Yii::$app->bot;
        $bot->setCurlOption(CURLOPT_PROXY, $this->socks5());

        $updates = $bot->getUpdates();

        foreach ($updates as $update) {
            $message = $update->getMessage();
            $messages[] = [
                'message' => $message->getText(),
                'username' => $message->getFrom()->getUsername()
            ];
        }

//        return $messages;
        /*return $this->render('receive', [
            'messages' => $messages
        ]);*/

        return $this->render('index', [
            'messages' => $messages
        ]);
    }

    public function actionSend()
    {
        /** @var Component $bot */
        $bot = \Yii::$app->bot;
        $bot->setCurlOption(CURLOPT_PROXY, $this->socks5());

        $chatId = 461471935;

        if ($message = \Yii::$app->request->post('message')) {
            $bot->sendMessage($chatId, $message);
        }

        return $this->redirect(Url::to('index'));
    }

    public function actionIndex()
    {
        return $this->render('index', [
        ]);
    }

    public function socks5()
    {
//        return 'socks5://192.169.217.40:17187';
        return 'socks5://79.106.133.123:1080';
    }

}
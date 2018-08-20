<?php

namespace console\controllers;

use common\models\tables\TelegramOffset;
use SonkoDmitry\Yii\TelegramBot\Component;
use TelegramBot\Api\Types\Message;
use TelegramBot\Api\Types\Update;
use yii\console\Controller;

class TelegramController extends Controller
{

    private $offset = 0;
    private $proxy = 'socks5://79.106.133.123:1080';
    /** @var Component $bot */
    private $bot;

    private function getProxy()
    {
        return $this->proxy;
    }

    public function init()
    {
        parent::init();
        $this->bot = \Yii::$app->bot;
        $this->bot->setCurlOption(CURLOPT_PROXY, $this->getProxy());
    }


    public function actionIndex()
    {
//        while (true) {
            $updates = $this->bot->getUpdates($this->getOffset() + 1);
            if (count($updates) > 0) {
                echo 'New messages in chat:' . count($updates) . PHP_EOL;
                foreach ($updates as $update) {
                    $this->updateOffset($update);
                    $this->processCommand($update->getMessage());
                }
            } else {
                echo 'No new messages' . PHP_EOL;
            }
            sleep(5);
//        }
    }

    private function getOffset()
    {
        $max = TelegramOffset::find()
            ->select('id')
            ->max('id');

        if ($max > 0) {
            $this->offset = $max;
        }

        return $this->offset;
    }

    private function updateOffset(Update $update)
    {
        $model = new TelegramOffset([
            'id' => $update->getUpdateId(),
            'timestamp_offset' => date('Y-m-d H:i:s')
        ]);

        $model->save();
    }

    private function processCommand(Message $message)
    {
        $params = explode(' ', $message->getText());
        $command = $params[0];

        switch ($command) {
            case '/help':
                $response = "Available commands: \n";
                $response .= '/sp_create ##project_name##';

                $this->bot->sendMessage($message->getFrom()->getId(), $response);
                break;
            case '/sp_create':
                $response = 'You\'re subscribe to notifications';
                $this->bot->sendMessage($message->getFrom()->getId(), $response);
                break;
            default:
                $response = 'unknown command';
                $this->bot->sendMessage($message->getFrom()->getId(), $response);
                break;
        }
    }
}
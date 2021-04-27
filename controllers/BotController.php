<?php

namespace app\controllers;

use Telegram\Bot\Api;
use app\models\Subscriber;

class BotController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $bot_api_key  = '1769404403:AAHMh5mrymiOC_THx5x2YdXXcx5RGFLz3EU';

        $telegram = new Api( $bot_api_key );

        $response = $telegram->getUpdates();

        foreach( $response as $update ) {
            $from = $update['message']['from'];
            echo '<pre style="font-family:\'JetBrains Mono\'">' . print_r( $from, true ) . '</pre>';

            $subscriber = new Subscriber;
            $subscriber->user_id   = $from['id'];
            $subscriber->firstname = $from['first_name'];
            $subscriber->username  = $from['username'];
            $subscriber->save();
        }
        // return $response;
    }
}

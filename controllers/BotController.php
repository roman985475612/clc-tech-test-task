<?php

namespace app\controllers;

use Telegram\Bot\Api;
use app\models\Subscriber;

class BotController extends \yii\web\Controller
{
    private const BASE_URL = 'https://api.telegram.org/bot';

    private function sendRequest($method, $params)
    {
        $url = BASE_URL . env( 'TG_TOKEN' ) . '/' . $method . '/';
        if( ! empty( $params ) ) {
            $url .= '?' . http_build_query( $params );
        }
        return json_decode(
            file_get_contents( $url ),
            JSON_OBJECT_AS_ARRAY
        );
    }

    public function actionIndex()
    {
        $base_url = 'https://api.telegram.org/bot';
        $bot_api_key  = '1611090732:AAHGrEEg9xjaR_Uqlt3-nRf80yVKkFKohy0';
        $method = 'getUpdates';

        $url = $base_url . $bot_api_key . '/' . $method;

        $update = json_decode(
            file_get_contents( $url ),
            JSON_OBJECT_AS_ARRAY
        );

        $ids = [];

        foreach( $update['result'] as $item ) {
            $ids[] = $item['message']['chat']['id'];
        }
        $ids = array_unique( $ids, SORT_NUMERIC );

        $msd = 'Hello!!';

        $method = 'sendMessage';

        foreach( $ids as $id ) {
            $params = http_build_query([
                'chat_id' => $id,
                'text' => 'Welcome to chat!'
            ]);
            $url = $base_url . $bot_api_key . '/' . $method . '?' . $params;
            $update = json_decode(
                file_get_contents( $url ),
                JSON_OBJECT_AS_ARRAY
            );
        }


        return '<pre>' . print_r( $update, true ) . '</pre>';

        // foreach( $response as $update ) {
        //     $from = $update['message']['from'];
        //     echo '<pre style="font-family:\'JetBrains Mono\'">' . print_r( $from, true ) . '</pre>';

        //     $subscriber = new Subscriber;
        //     $subscriber->user_id   = $from['id'];
        //     $subscriber->firstname = $from['first_name'];
        //     $subscriber->username  = $from['username'];
        //     $subscriber->save();
        // }
        return $response;
    }

    public function actionSetWebhook()
    {
        $method = 'setWebhook';

        $url = 'https://api.telegram.org/bot'
             . env( 'TG_TOKEN' ) . '/'
             . $method;

        $options = [
            'url' => 'https://bot.lisicyn-roman.ru/',
        ];

        $response = file_get_contents(
            $url . '?' . http_build_query( $options )
        );

        return $response;
    }
}

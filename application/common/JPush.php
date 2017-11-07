<?php
/**
 * Created by PhpStorm.
 * User: if-information
 * Date: 2017/11/6
 * Time: 下午2:54
 */
namespace JPush;
use jpush\src\JPush\Client;
use jpush\src\JPush\Exceptions;

class JPush {
    public static function push($message,$newsId)
    {
        $app_key = 'e488f3f5b427e6b8e7d56ebd';
        $master_secret = 'ad2d4181652ab32d9e7bd627';
        $client = new Client($app_key, $master_secret);
        $client->push()
            ->setPlatform('all')
            ->addAllAudience()
            ->setNotificationAlert('Hello, JPush')
            ->iosNotification(
                $message,[
                    'extras' => [
                        'newsId' => $newsId
                    ]
                ]
            )
            ->androidNotification(
                $message,[
                    'extras' => [
                        'newsId' => $newsId
                    ]
                ]
            )
            ->send();
    }

}


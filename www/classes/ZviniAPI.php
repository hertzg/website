<?php

class ZviniAPI {

    private static $BASE = 'http://api.zvini.com/';

    private static function post ($url, $params) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => self::$BASE.$url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($params),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 5,
        ));
        curl_exec($curl);
    }

    static function notify ($channelname, $channelkey, $notificationtext) {
        self::post('notify.php', array(
            'channelname' => $channelname,
            'channelkey' => $channelkey,
            'notificationtext' => $notificationtext,
        ));
    }

}

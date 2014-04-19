<?php

class ZviniClient {

    public $base = 'https://zvini.com/api-call/';
    public $api_key;

    function __construct ($api_key) {
        $this->api_key = $api_key;
    }

    function call ($method, array $params) {
        $params['api_key'] = $this->api_key;
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_POSTFIELDS => http_build_query($params),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 5,
            CURLOPT_URL => "$this->base$method.php",
        ]);
        $response = curl_exec($ch);
        $response = json_decode($response);
        return $response === true;
    }

}

<?php

class ZviniClient {

    public $api_key;
    public $base;

    function __construct ($api_key, $absolute_base) {
        $this->api_key = $api_key;
        $this->base = "{$absolute_base}api-call/";
    }

    function call ($method, $params) {
        $params['api_key'] = $this->api_key;
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_POSTFIELDS => http_build_query($params),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_URL => "$this->base$method",
        ]);
        $response = curl_exec($ch);
        $response = json_decode($response);
        return $response === true;
    }

}

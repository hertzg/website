<?php

class ZviniClient {

    public $api_key;
    public $base;

    function __construct ($api_key, $domain_name, $siteBase) {
        $this->api_key = $api_key;
        $this->base = "https://$domain_name{$siteBase}api-call/";
    }

    function call ($method, array $params) {
        $params['api_key'] = $this->api_key;
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_POSTFIELDS => http_build_query($params),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_URL => "$this->base$method.php",
        ]);
        $response = curl_exec($ch);
        $response = json_decode($response);
        return $response === true;
    }

}

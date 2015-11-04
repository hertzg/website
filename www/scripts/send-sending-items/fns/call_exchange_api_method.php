<?php

function call_exchange_api_method ($method, $receiver_address, $params) {

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => "{$receiver_address}exchange-api-call/$method",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => $params,
    ]);
    $response = curl_exec($ch);

    if ($response === false) {
        echo 'ERROR: '.curl_error($ch)."\n";
        exit(1);
    }

    if (curl_getinfo($ch, CURLINFO_HTTP_CODE) !== 200) {
        echo "ERROR: $response\n";
        exit(1);
    }

    $response = json_decode($response);
    if ($response !== true) {
        echo "ERROR: $response\n";
        exit(1);
    }

}

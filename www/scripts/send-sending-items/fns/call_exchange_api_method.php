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
        return false;
    }

    if (curl_getinfo($ch, CURLINFO_HTTP_CODE) !== 200) {
        $object = json_decode($response);
        if ($object === 'RECEIVER_NOT_RECEIVING') {
            // TODO do not ignore this event
            return false;
        }
        echo "ERROR: $response\n";
        return false;
    }

    $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
    if ($contentType !== 'application/json') {
        echo "ERROR: $response\n";
        return false;
    }

    $object = json_decode($response);
    if ($object !== true) {
        echo "ERROR: $response\n";
        return false;
    }

    return true;

}

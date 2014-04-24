<?php

function require_api_key () {

    include_once __DIR__.'/../../fns/request_strings.php';
    list($api_key) = request_strings('api_key');

    $api_key = hex2bin($api_key);

    include_once __DIR__.'/../../fns/get_mysqli.php';
    $mysqli = get_mysqli();

    include_once __DIR__.'/../../fns/ApiKeys/getByKey.php';
    $apiKey = ApiKeys\getByKey($mysqli, $api_key);

    if (!$apiKey) {
        http_response_code(403);
        header('Content-Type: application/json');
        die(json_encode([
            'error' => 'INVALID_API_KEY',
        ]));
    }

    return [$apiKey, $apiKey->id_users, $mysqli];

}

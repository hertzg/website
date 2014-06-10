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
        die('"INVALID_API_KEY"');
    }

    include_once __DIR__.'/../../fns/ApiKeys/updateAccessTime.php';
    ApiKeys\updateAccessTime($mysqli, $apiKey->id);

    include_once __DIR__.'/../../fns/Users/get.php';
    $user = Users\get($mysqli, $apiKey->id_users);

    return [$apiKey, $user, $mysqli];

}

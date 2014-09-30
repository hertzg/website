<?php

function require_api_key ($permission_field) {

    include_once __DIR__.'/../../fns/request_strings.php';
    list($api_key) = request_strings('api_key');

    $api_key = @hex2bin($api_key);

    include_once __DIR__.'/../../fns/get_mysqli.php';
    $mysqli = get_mysqli();

    include_once __DIR__.'/../../fns/ApiKeys/getByKey.php';
    $apiKey = ApiKeys\getByKey($mysqli, $api_key);

    if (!$apiKey) {
        http_response_code(403);
        header('Content-Type: application/json');
        die('"INVALID_API_KEY"');
    }

    if (!$apiKey->$permission_field) {
        http_response_code(403);
        header('Content-Type: application/json');
        die('"ACCESS_DENIED"');
    }

    include_once __DIR__.'/../../fns/ApiKeys/updateAccessTime.php';
    ApiKeys\updateAccessTime($mysqli, $apiKey->id);

    include_once __DIR__.'/../../fns/Users/get.php';
    $user = Users\get($mysqli, $apiKey->id_users);

    include_once __DIR__.'/../../fns/user_time_today.php';
    $time_today = user_time_today($user);

    $expire_time = $apiKey->expire_time;
    if ($expire_time !== null && $expire_time < $time_today) {
        http_response_code(403);
        header('Content-Type: application/json');
        die('"API_KEY_EXPIRED"');
    }

    return [$apiKey, $user, $mysqli];

}

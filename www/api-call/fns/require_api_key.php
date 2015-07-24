<?php

function require_api_key ($permission_field) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/request_strings.php";
    list($session_auth, $api_key) = request_strings('session_auth', 'api_key');

    include_once "$fnsDir/get_mysqli.php";
    $mysqli = get_mysqli();

    if ($session_auth) {

        include_once "$fnsDir/is_same_domain_referer.php";
        if (!is_same_domain_referer()) {
            http_response_code(403);
            header('Content-Type: application/json');
            die('"CROSS_DOMAIN_REQUEST"');
        }

        include_once "$fnsDir/signed_user.php";
        $user = signed_user();

        if (!$user) {
            http_response_code(403);
            header('Content-Type: application/json');
            die('"NOT_SIGNED_IN"');
        }

        $apiKey = null;

    } else {

        include_once "$fnsDir/ApiKeys/getByKey.php";
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

        $time = time();

        $expire_time = $apiKey->expire_time;
        if ($expire_time !== null && $expire_time < $time) {
            http_response_code(403);
            header('Content-Type: application/json');
            die('"API_KEY_EXPIRED"');
        }

        include_once "$fnsDir/ClientAddress/get.php";
        $client_address = ClientAddress\get();

        $access_time = $apiKey->access_time;
        if ($access_time === null || $access_time + 30 < $time ||
            $apiKey->access_remote_address !== $client_address) {

            include_once "$fnsDir/ApiKeys/editAccess.php";
            ApiKeys\editAccess($mysqli, $apiKey->id, $time, $client_address);

        }

        include_once "$fnsDir/Users/get.php";
        $user = Users\get($mysqli, $apiKey->id_users);

    }

    return [$apiKey, $user, $mysqli];

}

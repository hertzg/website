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
            include_once "$fnsDir/ErrorJson/forbidden.php";
            ErrorJson\forbidden('"CROSS_DOMAIN_REQUEST"');
        }

        include_once "$fnsDir/signed_user.php";
        $user = signed_user();

        if (!$user) {
            include_once "$fnsDir/ErrorJson/forbidden.php";
            ErrorJson\forbidden('"NOT_SIGNED_IN"');
        }

        if ($user->disabled) {
            include_once "$fnsDir/ErrorJson/forbidden.php";
            ErrorJson\forbidden('"USER_DISABLED"');
        }

        $apiKey = null;

    } else {

        include_once "$fnsDir/ApiKeys/getByKey.php";
        $apiKey = ApiKeys\getByKey($mysqli, $api_key);

        if (!$apiKey) {
            include_once "$fnsDir/ErrorJson/forbidden.php";
            ErrorJson\forbidden('"INVALID_API_KEY"');
        }

        if (!$apiKey->$permission_field) {
            include_once "$fnsDir/ErrorJson/forbidden.php";
            ErrorJson\forbidden('"ACCESS_DENIED"');
        }

        $time = time();

        $expire_time = $apiKey->expire_time;
        if ($expire_time !== null && $expire_time < $time) {
            include_once "$fnsDir/ErrorJson/forbidden.php";
            ErrorJson\forbidden('"API_KEY_EXPIRED"');
        }

        include_once "$fnsDir/Users/get.php";
        $user = Users\get($mysqli, $apiKey->id_users);

        if ($user->disabled) {
            include_once "$fnsDir/ErrorJson/forbidden.php";
            ErrorJson\forbidden('"USER_DISABLED"');
        }

        include_once "$fnsDir/ClientAddress/get.php";
        $client_address = ClientAddress\get();

        $access_time = $apiKey->access_time;
        if ($access_time === null || $access_time + 30 < $time ||
            $apiKey->access_remote_address !== $client_address) {

            include_once "$fnsDir/ApiKeys/editAccess.php";
            ApiKeys\editAccess($mysqli, $apiKey->id, $time, $client_address);

        }

    }

    return [$apiKey, $user, $mysqli];

}

<?php

function require_api_key ($permission_field, &$apiKey, &$user, &$mysqli) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/request_strings.php";
    list($session_auth, $api_key) = request_strings('session_auth', 'api_key');

    include_once "$fnsDir/require_mysqli.php";
    $mysqli = require_mysqli();

    if ($session_auth) {

        include_once "$fnsDir/ApiCall/requireUser.php";
        $user = ApiCall\requireUser();

        $apiKey = null;

    } else {

        include_once "$fnsDir/ApiKeys/getByKey.php";
        $apiKey = ApiKeys\getByKey($mysqli, $api_key);

        if (!$apiKey) {
            include_once "$fnsDir/ErrorJson/forbidden.php";
            ErrorJson\forbidden('"INVALID_API_KEY"');
        }

        if ($permission_field !== null && !$apiKey->$permission_field) {
            include_once "$fnsDir/ErrorJson/forbidden.php";
            ErrorJson\forbidden('"ACCESS_DENIED"');
        }

        $time = time();

        $expire_time = $apiKey->expire_time;
        if ($expire_time !== null && $expire_time < $time) {
            include_once "$fnsDir/ErrorJson/forbidden.php";
            ErrorJson\forbidden('"API_KEY_EXPIRED"');
        }

        $id_users = $apiKey->id_users;

        include_once "$fnsDir/Users/get.php";
        $user = Users\get($mysqli, $id_users);

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

        include_once "$fnsDir/ApiKeyAuths/add.php";
        ApiKeyAuths\add($mysqli, $apiKey->id, $id_users, $client_address);

    }

}

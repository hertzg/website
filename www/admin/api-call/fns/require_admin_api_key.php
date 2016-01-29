<?php

function require_admin_api_key ($permission_field, &$apiKey, &$mysqli) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($admin_api_key) = request_strings('admin_api_key');

    include_once "$fnsDir/require_mysqli.php";
    $mysqli = require_mysqli();

    include_once "$fnsDir/AdminApiKeys/getByKey.php";
    $apiKey = AdminApiKeys\getByKey($mysqli, $admin_api_key);

    if (!$apiKey) {
        include_once "$fnsDir/ErrorJson/forbidden.php";
        ErrorJson\forbidden('"INVALID_ADMIN_API_KEY"');
    }

    if ($permission_field !== null && !$apiKey->$permission_field) {
        include_once "$fnsDir/ErrorJson/forbidden.php";
        ErrorJson\forbidden('"ACCESS_DENIED"');
    }

    $time = time();

    $expire_time = $apiKey->expire_time;
    if ($expire_time !== null && $expire_time < $time) {
        include_once "$fnsDir/ErrorJson/forbidden.php";
        ErrorJson\forbidden('"ADMIN_API_KEY_EXPIRED"');
    }

    include_once "$fnsDir/ClientAddress/get.php";
    $client_address = ClientAddress\get();

    $access_time = $apiKey->access_time;
    if ($access_time === null || $access_time + 30 < $time ||
        $apiKey->access_remote_address !== $client_address) {

        include_once "$fnsDir/AdminApiKeys/editAccess.php";
        AdminApiKeys\editAccess($mysqli, $apiKey->id, $time, $client_address);

    }

    include_once "$fnsDir/AdminApiKeyAuths/add.php";
    AdminApiKeyAuths\add($mysqli, $apiKey->id, $client_address);

}

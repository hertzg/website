<?php

function require_admin_api_key ($permission_field, &$apiKey, &$mysqli) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($admin_api_key) = request_strings('admin_api_key');

    include_once "$fnsDir/get_mysqli.php";
    $mysqli = get_mysqli();

    include_once "$fnsDir/AdminApiKeys/getByKey.php";
    $apiKey = AdminApiKeys\getByKey($mysqli, $admin_api_key);

    if (!$apiKey) {
        include_once "$fnsDir/ErrorJson/forbidden.php";
        ErrorJson\forbidden('"INVALID_ADMIN_API_KEY"');
    }

    if (!$apiKey->$permission_field) {
        include_once "$fnsDir/ErrorJson/forbidden.php";
        ErrorJson\forbidden('"ACCESS_DENIED"');
    }

}
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
        http_response_code(403);
        header('Content-Type: application/json');
        echo '"INVALID_ADMIN_API_KEY"';
        exit;
    }

    if (!$apiKey->$permission_field) {
        http_response_code(403);
        header('Content-Type: application/json');
        echo '"ACCESS_DENIED"';
        exit;
    }

}

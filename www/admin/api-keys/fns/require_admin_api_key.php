<?php

function require_admin_api_key ($mysqli) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once __DIR__.'/../../fns/require_admin.php';
    require_admin();

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/AdminApiKeys/get.php";
    $apiKey = AdminApiKeys\get($mysqli, $id);

    if (!$apiKey) {
        $error = 'The admin API key no longer exists.';
        $_SESSION['admin/api-keys/errors'] = [$error];
        unset($_SESSION['admin/api-keys/messages']);
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return [$apiKey, $id];

}

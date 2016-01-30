<?php

function require_admin_api_key ($mysqli, $base = '') {

    include_once __DIR__.'/../../fns/require_admin.php';
    $admin_user = require_admin();

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/AdminApiKeys/get.php";
    $apiKey = AdminApiKeys\get($mysqli, $id);

    if (!$apiKey) {
        unset($_SESSION['admin/api-keys/messages']);
        $_SESSION['admin/api-keys/errors'] = [
            'The admin API key no longer exists.',
        ];
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    return [$apiKey, $id, $admin_user];

}

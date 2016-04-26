<?php

function require_api_key ($mysqli, $base = '') {

    include_once __DIR__.'/../../fns/require_user_with_password.php';
    $user = require_user_with_password('../../');

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/ApiKeys/get.php";
    $apiKey = Users\ApiKeys\get($mysqli, $user, $id);

    if (!$apiKey) {
        unset($_SESSION['account/api-keys/messages']);
        $_SESSION['account/api-keys/errors'] = [
            'The API key no longer exists.',
        ];
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    return [$apiKey, $id, $user];

}

<?php

function require_api_key ($mysqli) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../../');

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/ApiKeys/getOnUser.php";
    $apiKey = ApiKeys\getOnUser($mysqli, $user->id_users, $id);

    if (!$apiKey) {
        unset($_SESSION['accoint/api-keys/messages']);
        $_SESSION['account/api-keys/errors'] = [
            'The API key no longer exists.',
        ];
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return [$apiKey, $id, $user];

}

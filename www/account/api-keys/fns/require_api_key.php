<?php

function require_api_key ($mysqli) {

    include_once __DIR__.'/../../../fns/require_user.php';
    $user = require_user('../../../');

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once __DIR__.'/../../../fns/ApiKeys/getOnUser.php';
    $apiKey = ApiKeys\getOnUser($mysqli, $user->id_users, $id);

    if (!$apiKey) {
        unset($_SESSION['accoint/api-keys/messages']);
        $_SESSION['accoint/api-keys/errors'] = [
            'The API key no longer exists.',
        ];
        include_once __DIR__.'/../../../fns/redirect.php';
        redirect('..');
    }

    return [$apiKey, $id, $user];

}

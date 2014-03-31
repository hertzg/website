<?php

function require_token ($mysqli) {

    include_once __DIR__.'/../../fns/require_user.php';
    $user = require_user('../../');

    include_once __DIR__.'/../../fns/request_strings.php';
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once __DIR__.'/../../fns/Tokens/getOnUser.php';
    $token = Tokens\getOnUser($mysqli, $user->id_users, $id);

    if (!$token) {
        unset($_SESSION['tokens/messages']);
        $_SESSION['tokens/errors'] = [
            'The remembered session no longer exists.',
        ];
        include_once __DIR__.'/../../fns/redirect.php';
        redirect('..');
    }

    return [$token, $id, $user];

}

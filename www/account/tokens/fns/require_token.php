<?php

function require_token ($mysqli) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../../');

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Tokens/getOnUser.php";
    $token = Tokens\getOnUser($mysqli, $user->id_users, $id);

    if (!$token) {
        unset($_SESSION['account/tokens/messages']);
        $error = 'The remembered session no longer exists.';
        $_SESSION['account/tokens/errors'] = [$error];
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return [$token, $id, $user];

}

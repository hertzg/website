<?php

function require_token ($mysqli) {

    include_once __DIR__.'/../../fns/require_user_with_password.php';
    $user = require_user_with_password('../../');

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Tokens/get.php";
    $token = Users\Tokens\get($mysqli, $user, $id);

    if (!$token) {
        unset($_SESSION['account/tokens/messages']);
        $error = 'The remembered session no longer exists.';
        $_SESSION['account/tokens/errors'] = [$error];
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return [$token, $id, $user];

}

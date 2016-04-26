<?php

function require_connection ($mysqli) {

    include_once __DIR__.'/../../fns/require_user_with_password.php';
    $user = require_user_with_password('../../');

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Connections/get.php";
    $connection = Users\Connections\get($mysqli, $user, $id);

    if (!$connection) {
        unset($_SESSION['account/connections/messages']);
        $error = 'The connection no longer exists.';
        $_SESSION['account/connections/errors'] = [$error];
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return [$connection, $id, $user];

}

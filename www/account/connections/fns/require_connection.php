<?php

function require_connection ($mysqli) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../../');

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Connections/getOnUser.php";
    $connection = Connections\getOnUser($mysqli, $user->id_users, $id);

    if (!$connection) {
        unset($_SESSION['account/connections/messages']);
        $error = 'The connection no longer exists.';
        $_SESSION['account/connections/errors'] = [$error];
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return [$connection, $id, $user];

}

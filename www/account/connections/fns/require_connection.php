<?php

function require_connection ($mysqli) {

    include_once __DIR__.'/../../../fns/require_user.php';
    $user = require_user('../../../');

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once __DIR__.'/../../../fns/Connections/get.php';
    $connection = Connections\get($mysqli, $user->idusers, $id);

    if (!$connection) {
        unset($_SESSION['account/connections/index_messages']);
        $_SESSION['account/connections/index_errors'] = array(
            'The connection no longer exists.',
        );
        include_once __DIR__.'/../../../fns/redirect.php';
        redirect('..');
    }

    return array($connection, $id, $user);

}

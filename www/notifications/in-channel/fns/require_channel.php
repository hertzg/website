<?php

function require_channel ($mysqli, $requireUserBase, $base) {

    include_once __DIR__.'/../../../fns/require_user.php';
    $user = require_user($requireUserBase);

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once __DIR__.'/../../../fns/Channels/get.php';
    $channel = Channels\get($mysqli, $user->idusers, $id);

    if (!$channel) {
        unset($_SESSION['notifications/index_messages']);
        $_SESSION['notifications/index_errors'] = array(
            'The channel no longer exists.',
        );
        include_once __DIR__.'/../../../fns/redirect.php';
        redirect($base);
    }

    return array($channel, $id, $user);

}

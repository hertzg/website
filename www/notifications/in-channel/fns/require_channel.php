<?php

function require_channel ($mysqli, $base) {

    include_once __DIR__.'/../../../fns/require_user.php';
    $user = require_user("$base/../");
    $idusers = $user->idusers;

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once __DIR__.'/../../../fns/Channels/getOnUser.php';
    $channel = Channels\getOnUser($mysqli, $idusers, $id);

    if (!$channel) {
        unset($_SESSION['notifications/messages']);
        $_SESSION['notifications/errors'] = [
            'The channel no longer exists.',
        ];
        include_once __DIR__.'/../../../fns/redirect.php';
        redirect($base);
    }

    return [$channel, $id, $user];

}

<?php

function require_channel ($mysqli, $channelsBase = '..') {

    include_once __DIR__.'/../../fns/require_user.php';
    $user = require_user("$channelsBase/../");

    include_once __DIR__.'/../../fns/request_strings.php';
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once __DIR__.'/../../fns/Channels/getOnUser.php';
    $channel = Channels\getOnUser($mysqli, $user->idusers, $id);

    if (!$channel) {
        unset($_SESSION['channels/messages']);
        $_SESSION['channels/errors'] = [
            'The channel no longer exists.',
        ];
        include_once __DIR__.'/../../fns/redirect.php';
        redirect($channelsBase);
    }

    return [$channel, $id, $user];

}

<?php

function require_channel ($mysqli) {

    include_once __DIR__.'/../../fns/require_user.php';
    $user = require_user('../../');

    include_once __DIR__.'/../../fns/request_strings.php';
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once __DIR__.'/../../fns/Channels/get.php';
    $channel = Channels\get($mysqli, $user->idusers, $id);

    if (!$channel) {
        unset($_SESSION['channels/messages']);
        $_SESSION['channels/errors'] = array(
            'The channel no longer exists.',
        );
        include_once __DIR__.'/../../fns/redirect.php';
        redirect('..');
    }

    return array($channel, $id, $user);

}

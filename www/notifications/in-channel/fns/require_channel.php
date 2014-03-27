<?php

function require_channel ($mysqli, $requireUserBase, $base) {

    include_once __DIR__.'/../../../fns/require_user.php';
    $user = require_user($requireUserBase);

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($id, $id_subscribed_channels) = request_strings(
        'id', 'id_subscribed_channels');

    $id = abs((int)$id);
    $id_subscribed_channels = abs((int)$id_subscribed_channels);

    include_once __DIR__.'/../../../fns/Channels/getOnUser.php';
    $channel = Channels\getOnUser($mysqli, $user->idusers, $id);

    if (!$channel) {
        unset($_SESSION['notifications/messages']);
        $_SESSION['notifications/errors'] = array(
            'The channel no longer exists.',
        );
        include_once __DIR__.'/../../../fns/redirect.php';
        redirect($base);
    }

    return array($channel, $id, $user);

}

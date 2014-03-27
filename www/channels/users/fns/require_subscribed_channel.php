<?php

function require_subscribed_channel ($mysqli) {

    include_once __DIR__.'/../../../fns/require_user.php';
    $user = require_user('../../../');

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once __DIR__.'/../../../fns/SubscribedChannels/getOnUser.php';
    $subscribedChannel = SubscribedChannels\getOnUser($mysqli, $user->idusers, $id);

    if (!$subscribedChannel) {
        include_once __DIR__.'/../../../fns/redirect.php';
        redirect('..');
    }

    return [$subscribedChannel, $id, $user];

}

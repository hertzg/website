<?php

function require_subscribed_channel ($mysqli) {

    include_once __DIR__.'/../../../fns/require_user.php';
    $user = require_user('../../../');

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once __DIR__.'/../../../fns/SubscribedChannels/getOnSubscriber.php';
    $subscribedChannel = SubscribedChannels\getOnSubscriber(
        $mysqli, $user->id_users, $id);

    if (!$subscribedChannel) {
        include_once __DIR__.'/../../../fns/redirect.php';
        redirect('..');
    }

    return [$subscribedChannel, $id, $user];

}

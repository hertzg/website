<?php

function require_subscribed_channel ($mysqli, $base) {

    include_once __DIR__.'/../../../fns/require_user.php';
    $user = require_user("$base/../");
    $id_users = $user->id_users;

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once __DIR__.'/../../../fns/SubscribedChannels/getOnSubscriber.php';
    $subscribedChannel = SubscribedChannels\getOnSubscriber(
        $mysqli, $id_users, $id);

    if (!$subscribedChannel) {
        unset($_SESSION['notifications/messages']);
        $_SESSION['notifications/errors'] = [
            'The channel no longer exists.',
        ];
        include_once __DIR__.'/../../../fns/redirect.php';
        redirect($base);
    }

    return [$subscribedChannel, $id, $user];

}

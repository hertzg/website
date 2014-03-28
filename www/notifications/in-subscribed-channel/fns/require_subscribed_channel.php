<?php

function require_subscribed_channel ($mysqli, $base) {

    include_once __DIR__.'/../../../fns/require_user.php';
    $user = require_user("$base/../");
    $idusers = $user->idusers;

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once __DIR__.'/../../../fns/SubscribedChannels/getOnSubscribedUser.php';
    $subscribedChannel = SubscribedChannels\getOnSubscribedUser($mysqli, $idusers, $id);

    if (!$subscribedChannel) {
        unset($_SESSION['notifications/messages']);
        $_SESSION['notifications/errors'] = array(
            'The channel no longer exists.',
        );
        include_once __DIR__.'/../../../fns/redirect.php';
        redirect($base);
    }
    
    return array($subscribedChannel, $id, $user);

}

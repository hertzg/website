<?php

function require_subscribed_channel ($mysqli, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/SubscribedChannels/getOnSubscriber.php";
    $subscribedChannel = SubscribedChannels\getOnSubscriber(
        $mysqli, $user->id_users, $id);

    if (!$subscribedChannel) {
        unset($_SESSION['notifications/messages']);
        $_SESSION['notifications/errors'] = ['The channel no longer exists.'];
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    return [$subscribedChannel, $id, $user];

}

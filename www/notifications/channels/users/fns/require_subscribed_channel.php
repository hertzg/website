<?php

function require_subscribed_channel ($mysqli) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../../../');

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/SubscribedChannels/getOnPublisher.php";
    $subscribedChannel = SubscribedChannels\getOnPublisher(
        $mysqli, $user->id_users, $id);

    if (!$subscribedChannel || !$subscribedChannel->publisher_locked) {
        include_once "$fnsDir/redirect.php";
        redirect('../..');
    }

    return [$subscribedChannel, $id, $user];

}

<?php

function require_subscribed_channel ($mysqli) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../../');

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/SubscribedChannels/getOnSubscriber.php";
    $subscribedChannel = SubscribedChannels\getOnSubscriber(
        $mysqli, $user->id_users, $id);

    if (!$subscribedChannel) {
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return [$subscribedChannel, $id, $user];

}

<?php

function require_subscribed_channel ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/SubscribedChannels/getOnSubscriber.php";
    $subscribedChannel = SubscribedChannels\getOnSubscriber(
        $mysqli, $id_users, $id);

    if (!$subscribedChannel) {
        include_once __DIR__.'/../../../fns/bad_request.php';
        bad_request('SUBSCRIBED_CHANNEL_NOT_FOUND');
    }

    return $subscribedChannel;

}

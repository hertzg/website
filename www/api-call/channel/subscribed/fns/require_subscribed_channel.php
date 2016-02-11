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
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"SUBSCRIBED_CHANNEL_NOT_FOUND"');
    }

    return $subscribedChannel;

}

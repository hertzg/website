<?php

namespace Users\Channels\Users;

function index ($mysqli, $channel) {

    if (!$channel->num_users) return [];

    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/SubscribedChannels/indexPublisherLockedOnChannel.php";
    return \SubscribedChannels\indexPublisherLockedOnChannel(
        $mysqli, $channel->id);

}

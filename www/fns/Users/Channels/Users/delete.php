<?php

namespace Users\Channels\Users;

function delete ($mysqli, $subscribedChannel) {

    $fnsDir = __DIR__.'/../../..';
    $id = $subscribedChannel->id;

    if ($subscribedChannel->subscriber_locked) {
        include_once "$fnsDir/SubscribedChannels/setPublisherLocked.php";
        \SubscribedChannels\setPublisherLocked($mysqli, $id, false);
    } else {

        include_once "$fnsDir/SubscribedChannels/delete.php";
        \SubscribedChannels\delete($mysqli, $id);

        include_once "$fnsDir/Users/SubscribedChannels/addNumber.php";
        \Users\SubscribedChannels\addNumber($mysqli,
            $subscribedChannel->subscriber_id_users, -1);

    }

    include_once "$fnsDir/Channels/addNumUsers.php";
    \Channels\addNumUsers($mysqli, $subscribedChannel->id_channels, -1);

}

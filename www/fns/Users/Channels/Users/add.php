<?php

namespace Users\Channels\Users;

function add ($mysqli, $user, $channel, $subscribedChannel, $subscriberUser) {

    $fnsDir = __DIR__.'/../../..';

    $id = $channel->id;

    if ($subscribedChannel) {

        $new_id = $subscribedChannel->id;

        include_once "$fnsDir/SubscribedChannels/setPublisherLocked.php";
        \SubscribedChannels\setPublisherLocked($mysqli, $new_id, true);

    } else {

        $subscriber_id_users = $subscriberUser->id_users;

        include_once "$fnsDir/SubscribedChannels/add.php";
        $new_id = \SubscribedChannels\add($mysqli, $id,
            $channel->channel_name, $channel->public, $user->id_users,
            $user->username, true, $subscriber_id_users,
            $subscriberUser->username, false, false);

        include_once "$fnsDir/Users/SubscribedChannels/addNumber.php";
        \Users\SubscribedChannels\addNumber($mysqli, $subscriber_id_users, 1);

    }

    include_once "$fnsDir/Channels/addNumUsers.php";
    \Channels\addNumUsers($mysqli, $id, 1);

    return $new_id;

}

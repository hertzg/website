<?php

namespace Users\SubscribedChannels;

function add ($mysqli, $user, $channel,
    $subscribedChannel, $receive_notifications) {

    $fnsDir = __DIR__.'/../..';

    if ($subscribedChannel) {
        $id = $subscribedChannel->id;
        include_once "$fnsDir/SubscribedChannels/setSubscriberLocked.php";
        \SubscribedChannels\setSubscriberLocked($mysqli, $id, true);
    } else {

        $id_users = $user->id_users;

        include_once "$fnsDir/SubscribedChannels/add.php";
        $id = \SubscribedChannels\add($mysqli, $channel->id,
            $channel->channel_name, $channel->public, $channel->id_users,
            $channel->username, false, $id_users, $user->username, true,
            $receive_notifications);

        include_once __DIR__.'/addNumber.php';
        addNumber($mysqli, $id_users, 1);

    }

    return $id;

}

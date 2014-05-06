<?php

namespace Users\Notifications;

function post ($mysqli, $channel, $notification_text) {

    $id_users = $channel->id_users;
    $id_channels = $channel->id;
    $channel_name = $channel->channel_name;

    if ($channel->receive_notifications) {

        include_once __DIR__.'/../../Notifications/add.php';
        \Notifications\add($mysqli, $id_users, $id_channels,
            $channel_name, $notification_text);

        include_once __DIR__.'/addNumberNew.php';
        addNumberNew($mysqli, $id_users, 1);

    }

    include_once __DIR__.'/../../SubscribedChannels/indexOnChannel.php';
    $subscribedChannels = \SubscribedChannels\indexOnChannel(
        $mysqli, $id_channels);

    if ($subscribedChannels) {
        include_once __DIR__.'/../../Notifications/addExternal.php';
        include_once __DIR__.'/../../SubscribedChannels/addNumNotifications.php';
        include_once __DIR__.'/addNumberNew.php';
        foreach ($subscribedChannels as $subscribedChannel) {
            if ($subscribedChannel->receive_notifications) {
                $id = $subscribedChannel->id;
                $id_users = $subscribedChannel->subscriber_id_users;
                \Notifications\addExternal($mysqli, $id_users,
                    $id_channels, $channel_name, $notification_text, $id);
                addNumberNew($mysqli, $id_users, 1);
                \SubscribedChannels\addNumNotifications($mysqli, $id, 1);
            }
        }
    }

}

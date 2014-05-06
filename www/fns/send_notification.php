<?php

function send_notification ($mysqli, $channel, $notification_text) {

    $id_users = $channel->id_users;
    $id_channels = $channel->id;
    $channel_name = $channel->channel_name;

    if ($channel->receive_notifications) {

        include_once __DIR__.'/Notifications/add.php';
        Notifications\add($mysqli, $id_users, $id_channels,
            $channel_name, $notification_text);

        include_once __DIR__.'/Users/Notifications/addNumberNew.php';
        Users\Notifications\addNumberNew($mysqli, $id_users, 1);

    }

    include_once __DIR__.'/SubscribedChannels/indexOnChannel.php';
    $subscribedChannels = SubscribedChannels\indexOnChannel(
        $mysqli, $id_channels);

    if ($subscribedChannels) {
        include_once __DIR__.'/Notifications/addExternal.php';
        include_once __DIR__.'/Users/Notifications/addNumberNew.php';
        foreach ($subscribedChannels as $subscribedChannel) {
            if ($subscribedChannel->receive_notifications) {
                $id_users = $subscribedChannel->subscriber_id_users;
                Notifications\addExternal($mysqli, $id_users,
                    $id_channels, $channel_name, $notification_text,
                    $subscribedChannel->id);
                Users\Notifications\addNumberNew($mysqli, $id_users, 1);
            }
        }
    }

}

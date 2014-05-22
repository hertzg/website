<?php

namespace Users\Notifications;

function post ($mysqli, $channel, $notification_text) {

    $fnsDir = __DIR__.'/../../';

    $id_users = $channel->id_users;
    $id_channels = $channel->id;
    $channel_name = $channel->channel_name;

    if ($channel->receive_notifications) {

        include_once "$fnsDir/Notifications/addOnChannel.php";
        \Notifications\addOnChannel($mysqli, $id_users, $id_channels,
            $channel_name, $notification_text);

        include_once "$fnsDir/Channels/addNumNotifications.php";
        \Channels\addNumNotifications($mysqli, $id_channels, 1);

        include_once __DIR__.'/addNumberNew.php';
        addNumberNew($mysqli, $id_users, 1);

    }

    include_once "$fnsDir/SubscribedChannels/indexOnChannel.php";
    $subscribedChannels = \SubscribedChannels\indexOnChannel(
        $mysqli, $id_channels);

    $callback = function ($subscribedChannel) {
        return $subscribedChannel->receive_notifications;
    };
    $subscribedChannels = array_filter($subscribedChannels, $callback);

    if ($subscribedChannels) {
        include_once "$fnsDir/Notifications/addOnSubscribedChannel.php";
        include_once "$fnsDir/SubscribedChannels/addNumNotifications.php";
        include_once __DIR__.'/addNumberNew.php';
        foreach ($subscribedChannels as $subscribedChannel) {
            $id = $subscribedChannel->id;
            $id_users = $subscribedChannel->subscriber_id_users;
            \Notifications\addOnSubscribedChannel($mysqli, $id_users,
                $channel_name, $notification_text, $id);
            \SubscribedChannels\addNumNotifications($mysqli, $id, 1);
            addNumberNew($mysqli, $id_users, 1);
        }
    }

}

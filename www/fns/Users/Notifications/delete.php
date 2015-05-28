<?php

namespace Users\Notifications;

function delete ($mysqli, $notification) {

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Notifications/delete.php";
    \Notifications\delete($mysqli, $notification->id);

    $id_channels = $notification->id_channels;
    if ($id_channels) {
        include_once "$fnsDir/Channels/addNumNotifications.php";
        \Channels\addNumNotifications($mysqli, $id_channels, -1);
    } else {
        include_once "$fnsDir/SubscribedChannels/addNumNotifications.php";
        \SubscribedChannels\addNumNotifications($mysqli,
            $notification->id_subscribed_channels, -1);
    }

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $notification->id_users, -1);

}

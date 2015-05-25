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

    $sql = 'update users set num_new_notifications = 0,'
        .' home_num_new_notifications = 0'
        ." where id_users = $notification->id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}

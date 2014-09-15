<?php

namespace Users\Notifications;

function deleteAll ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Notifications/deleteAllOnUser.php";
    \Notifications\deleteAllOnUser($mysqli, $id_users);

    include_once "$fnsDir/Channels/clearNumNotificationsOnUser.php";
    \Channels\clearNumNotificationsOnUser($mysqli, $id_users);

    $path = "$fnsDir/SubscribedChannels/clearNumNotificationsOnSubscriber.php";
    include_once $path;
    \SubscribedChannels\clearNumNotificationsOnSubscriber($mysqli, $id_users);

    $sql = 'update users set num_notifications = 0,'
        .' num_new_notifications = 0, home_num_new_notifications = 0'
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}

<?php

namespace Users\Notifications;

function deleteAll ($mysqli, $id_users) {

    include_once __DIR__.'/../../Notifications/deleteAllOnUser.php';
    \Notifications\deleteAllOnUser($mysqli, $id_users);

    include_once __DIR__.'/clearNumber.php';
    clearNumber($mysqli, $id_users);

    include_once __DIR__.'/../../Channels/clearNumNotificationsOnUser.php';
    \Channels\clearNumNotificationsOnUser($mysqli, $id_users);

    include_once __DIR__.'/../../SubscribedChannels/clearNumNotificationsOnSubscriber.php';
    \SubscribedChannels\clearNumNotificationsOnSubscriber($mysqli, $id_users);

}

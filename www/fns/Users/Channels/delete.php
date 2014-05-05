<?php

namespace Users\Channels;

function delete ($mysqli, $id, $id_users) {

    include_once __DIR__.'/../../Notifications/deleteOnChannel.php';
    \Notifications\deleteOnChannel($mysqli, $id);

    include_once __DIR__.'/../../Channels/delete.php';
    \Channels\delete($mysqli, $id);

    include_once __DIR__.'/../../SubscribedChannels/deleteOnChannel.php';
    \SubscribedChannels\deleteOnChannel($mysqli, $id);

    include_once __DIR__.'/../../Users/Channels/addNumber.php';
    \Users\Channels\addNumber($mysqli, $id_users, -1);

    include_once __DIR__.'/../../Users/clearNumNotifications.php';
    \Users\clearNumNotifications($mysqli, $id_users);

}

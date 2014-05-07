<?php

namespace Users\Channels;

function delete ($mysqli, $channel) {

    $id = $channel->id;
    $id_users = $channel->id_users;

    include_once __DIR__.'/../../Notifications/deleteOnChannel.php';
    \Notifications\deleteOnChannel($mysqli, $id);

    include_once __DIR__.'/../../Channels/delete.php';
    \Channels\delete($mysqli, $id);

    include_once __DIR__.'/../../SubscribedChannels/deleteOnChannel.php';
    \SubscribedChannels\deleteOnChannel($mysqli, $id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, -1);

    include_once __DIR__.'/../Notifications/addNumber.php';
    \Users\Notifications\addNumber($mysqli, $id_users, -$channel->num_notifications);

}

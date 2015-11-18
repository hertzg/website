<?php

namespace Users\Connections;

function edit ($mysqli, $connection, $connected_id_users,
    $username, $address, $expire_time, $can_send_bookmark,
    $can_send_channel, $can_send_contact, $can_send_file,
    $can_send_note, $can_send_place, $can_send_schedule,
    $can_send_task, &$changed) {

    $connected_id_users_same = $connection->connected_id_users === null &&
        $connected_id_users === null;
    $connected_id_users_same = $connected_id_users_same ||
        (int)$connection->connected_id_users === (int)$connected_id_users;

    if ($connected_id_users_same && $connection->username === $username &&
        $connection->address === $address) {

        if (($connection->expire_time === null && $expire_time === null) ||
            (int)$connection->expire_time === $expire_time) {

            if ((bool)$connection->can_send_bookmark === $can_send_bookmark &&
                (bool)$connection->can_send_channel === $can_send_channel &&
                (bool)$connection->can_send_contact === $can_send_contact &&
                (bool)$connection->can_send_file === $can_send_file &&
                (bool)$connection->can_send_note === $can_send_note &&
                (bool)$connection->can_send_place === $can_send_place &&
                (bool)$connection->can_send_schedule === $can_send_schedule &&
                (bool)$connection->can_send_task === $can_send_task) return;

        }

    }

    $changed = true;

    include_once __DIR__.'/../../Connections/edit.php';
    \Connections\edit($mysqli, $connection->id,
        $connected_id_users, $username, $address, $expire_time,
        $can_send_bookmark, $can_send_channel, $can_send_contact,
        $can_send_file, $can_send_note, $can_send_place,
        $can_send_schedule, $can_send_task);

    include_once __DIR__.'/../SubscribedChannels/deleteDisconnected.php';
    \Users\SubscribedChannels\deleteDisconnected(
        $mysqli, $connection->id_users);

}

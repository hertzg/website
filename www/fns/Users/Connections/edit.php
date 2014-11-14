<?php

namespace Users\Connections;

function edit ($mysqli, $id, $id_users, $connected_id_users, $username,
    $expire_time, $can_send_bookmark, $can_send_channel, $can_send_contact,
    $can_send_file, $can_send_note, $can_send_task) {

    include_once __DIR__.'/../../Connections/edit.php';
    \Connections\edit($mysqli, $id, $connected_id_users, $username,
        $expire_time, $can_send_bookmark, $can_send_channel, $can_send_contact,
        $can_send_file, $can_send_note, $can_send_task);

    include_once __DIR__.'/../SubscribedChannels/deleteDisconnected.php';
    \Users\SubscribedChannels\deleteDisconnected($mysqli, $id_users);

}

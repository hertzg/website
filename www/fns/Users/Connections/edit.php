<?php

namespace Users\Connections;

function edit ($mysqli, $id, $connected_id_users, $username,
    $can_send_bookmark, $can_send_channel, $can_send_contact,
    $can_send_file, $can_send_note, $can_send_task) {

    include_once __DIR__.'/../../Connections/edit.php';
    \Connections\edit($mysqli, $id, $connected_id_users, $username,
        $can_send_bookmark, $can_send_channel, $can_send_contact,
        $can_send_file, $can_send_note, $can_send_task);

}

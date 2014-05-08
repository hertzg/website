<?php

namespace Users\Connections;

function add ($mysqli, $id_users, $connected_id_users,
    $username, $can_send_bookmark, $can_send_channel, $can_send_contact,
    $can_send_file, $can_send_note, $can_send_task) {

    include_once __DIR__.'/../../Connections/add.php';
    $id = \Connections\add($mysqli, $id_users, $connected_id_users,
        $username, $can_send_bookmark, $can_send_channel, $can_send_contact,
        $can_send_file, $can_send_note, $can_send_task);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    return $id;

}

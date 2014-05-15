<?php

namespace Connections;

function edit ($mysqli, $id, $connected_id_users, $username,
    $can_send_bookmark, $can_send_channel, $can_send_contact,
    $can_send_file, $can_send_note, $can_send_task) {

    $username = $mysqli->real_escape_string($username);
    $can_send_bookmark = $can_send_bookmark ? '1' : '0';
    $can_send_channel = $can_send_channel ? '1' : '0';
    $can_send_contact = $can_send_contact ? '1' : '0';
    $can_send_file = $can_send_file ? '1' : '0';
    $can_send_note = $can_send_note ? '1' : '0';
    $can_send_task = $can_send_task ? '1' : '0';

    $sql = 'update connections set'
        ." connected_id_users = $connected_id_users, username = '$username',"
        ." can_send_bookmark = $can_send_bookmark,"
        ." can_send_channel = $can_send_channel,"
        ." can_send_contact = $can_send_contact,"
        ." can_send_file = $can_send_file, can_send_note = $can_send_note,"
        ." can_send_task = $can_send_task, num_edits = num_edits + 1"
        ." where id = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}

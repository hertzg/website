<?php

namespace Users;

function editAnonymousConnection ($mysqli, $id_users, $can_send_bookmark,
    $can_send_channel, $can_send_contact, $can_send_file, $can_send_note,
    $can_send_task) {

    $can_send_bookmark = $can_send_bookmark ? '1' : '0';
    $can_send_channel = $can_send_channel ? '1' : '0';
    $can_send_contact = $can_send_contact ? '1' : '0';
    $can_send_file = $can_send_file ? '1' : '0';
    $can_send_note = $can_send_note ? '1' : '0';
    $can_send_task = $can_send_task ? '1' : '0';

    $sql = "update users set anonymous_can_send_bookmark = $can_send_bookmark,"
        ." anonymous_can_send_channel = $can_send_channel,"
        ." anonymous_can_send_contact = $can_send_contact,"
        ." anonymous_can_send_file = $can_send_file,"
        ." anonymous_can_send_note = $can_send_note,"
        ." anonymous_can_send_task = $can_send_task"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}

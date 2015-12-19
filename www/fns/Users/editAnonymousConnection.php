<?php

namespace Users;

function editAnonymousConnection ($mysqli, $id_users,
    $can_send_bookmark, $can_send_calculation, $can_send_channel,
    $can_send_contact, $can_send_file, $can_send_note, $can_send_place,
    $can_send_schedule, $can_send_task) {

    $can_send_bookmark = $can_send_bookmark ? '1' : '0';
    $can_send_calculation = $can_send_calculation ? '1' : '0';
    $can_send_channel = $can_send_channel ? '1' : '0';
    $can_send_contact = $can_send_contact ? '1' : '0';
    $can_send_file = $can_send_file ? '1' : '0';
    $can_send_note = $can_send_note ? '1' : '0';
    $can_send_place = $can_send_place ? '1' : '0';
    $can_send_schedule = $can_send_schedule ? '1' : '0';
    $can_send_task = $can_send_task ? '1' : '0';

    $sql = "update users set anonymous_can_send_bookmark = $can_send_bookmark,"
        ." anonymous_can_send_calculation = $can_send_calculation,"
        ." anonymous_can_send_channel = $can_send_channel,"
        ." anonymous_can_send_contact = $can_send_contact,"
        ." anonymous_can_send_file = $can_send_file,"
        ." anonymous_can_send_note = $can_send_note,"
        ." anonymous_can_send_place = $can_send_place,"
        ." anonymous_can_send_schedule = $can_send_schedule,"
        ." anonymous_can_send_task = $can_send_task"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

    include_once __DIR__.'/SubscribedChannels/deleteDisconnected.php';
    \Users\SubscribedChannels\deleteDisconnected($mysqli, $id_users);

}

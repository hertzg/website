<?php

namespace Connections;

function add ($mysqli, $id_users, $connected_id_users,
    $username, $address, $expire_time, $can_send_bookmark,
    $can_send_calculation, $can_send_channel, $can_send_contact,
    $can_send_file, $can_send_note, $can_send_place,
    $can_send_schedule, $can_send_task) {

    if ($connected_id_users === null) $connected_id_users = 'null';
    $username = $mysqli->real_escape_string($username);
    if ($address === null) $address = 'null';
    else $address = "'".$mysqli->real_escape_string($address)."'";
    if ($expire_time === null) $expire_time = 'null';
    $can_send_bookmark = $can_send_bookmark ? '1' : '0';
    $can_send_calculation = $can_send_calculation ? '1' : '0';
    $can_send_channel = $can_send_channel ? '1' : '0';
    $can_send_contact = $can_send_contact ? '1' : '0';
    $can_send_file = $can_send_file ? '1' : '0';
    $can_send_note = $can_send_note ? '1' : '0';
    $can_send_place = $can_send_place ? '1' : '0';
    $can_send_schedule = $can_send_schedule ? '1' : '0';
    $can_send_task = $can_send_task ? '1' : '0';
    $insert_time = $update_time = time();

    $sql = 'insert into connections'
        .' (id_users, connected_id_users,'
        .' username, address, expire_time,'
        .' can_send_bookmark, can_send_calculation,'
        .' can_send_channel, can_send_contact,'
        .' can_send_file, can_send_note, can_send_place,'
        .' can_send_schedule, can_send_task, insert_time, update_time)'
        ." value ($id_users, $connected_id_users,"
        ." '$username', $address, $expire_time,"
        ." $can_send_bookmark, $can_send_calculation,"
        ." $can_send_channel, $can_send_contact,"
        ." $can_send_file, $can_send_note, $can_send_place,"
        ." $can_send_schedule, $can_send_task, $insert_time, $update_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}

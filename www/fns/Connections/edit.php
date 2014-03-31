<?php

namespace Connections;

function edit ($mysqli, $id, $connected_id_users, $username, $can_send_channel) {
    $username = $mysqli->real_escape_string($username);
    $can_send_channel = $can_send_channel ? '1' : '0';
    $sql = 'update connections set'
        ." connected_id_users = $connected_id_users, username = '$username',"
        ." can_send_channel = $can_send_channel where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

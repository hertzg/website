<?php

namespace Connections;

function edit ($mysqli, $id, $connected_id_users, $username, $can_subscribe_to_my_channel) {
    $username = $mysqli->real_escape_string($username);
    $can_subscribe_to_my_channel = $can_subscribe_to_my_channel ? '1' : '0';
    $sql = 'update connections set'
        ." connected_id_users = $connected_id_users, username = '$username',"
        ." can_subscribe_to_my_channel = $can_subscribe_to_my_channel"
        ." where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

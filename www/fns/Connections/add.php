<?php

namespace Connections;

function add ($mysqli, $id_users, $connected_id_users, $username,
    $can_send_channel) {

    $username = $mysqli->real_escape_string($username);
    $can_send_channel = $can_send_channel ? '1' : '0';
    $insert_time = $update_time = time();

    $sql = 'insert into connections'
        .' (id_users, connected_id_users, username,'
        .' can_send_channel, insert_time, update_time)'
        ." value ($id_users, $connected_id_users, '$username',"
        ." $can_send_channel, $insert_time, $update_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}

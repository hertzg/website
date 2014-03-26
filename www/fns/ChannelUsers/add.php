<?php

namespace ChannelUsers;

function add ($mysqli, $id_channels, $id_users, $username) {
    $username = $mysqli->real_escape_string($username);
    $insert_time = time();
    $sql = 'insert into channel_users'
        .' (id_channels, id_users, username, insert_time)'
        ." values ($id_channels, $id_users, '$username', $insert_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);
    return $mysqli->insert_id;
}

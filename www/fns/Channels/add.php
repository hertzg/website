<?php

namespace Channels;

function add ($mysqli, $id_users, $username, $channel_name, $public) {

    $username = $mysqli->real_escape_string($username);
    $channel_name = $mysqli->real_escape_string($channel_name);
    $public = $public ? '1' : '0';
    $insert_time = time();

    $sql = 'insert into channels (id_users, username,'
        .' channel_name, public, insert_time)'
        ." values ($id_users, '$username',"
        ." '$channel_name', $public, $insert_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}

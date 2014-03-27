<?php

namespace ChannelUsers;

function add ($mysqli, $id_channels, $channel_name, $id_users,
    $username, $subscribed_id_users, $subscribed_username) {

    $channel_name = $mysqli->real_escape_string($channel_name);
    $username = $mysqli->real_escape_string($username);
    $subscribed_username = $mysqli->real_escape_string($subscribed_username);
    $insert_time = time();

    $sql = 'insert into channel_users'
        .' (id_channels, channel_name, id_users, username,'
        .' subscribed_id_users, subscribed_username, insert_time)'
        ." values ($id_channels, '$channel_name', $id_users, '$username',"
        ." $subscribed_id_users, '$subscribed_username', $insert_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);
    return $mysqli->insert_id;

}

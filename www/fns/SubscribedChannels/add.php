<?php

namespace SubscribedChannels;

function add ($mysqli, $id_channels, $channel_name, $id_users,
    $username, $subscriber_id_users, $subscriber_username) {

    $channel_name = $mysqli->real_escape_string($channel_name);
    $username = $mysqli->real_escape_string($username);
    $subscriber_username = $mysqli->real_escape_string($subscriber_username);
    $insert_time = time();

    $sql = 'insert into subscribed_channels'
        .' (id_channels, channel_name, id_users, username,'
        .' subscriber_id_users, subscriber_username, insert_time)'
        ." values ($id_channels, '$channel_name', $id_users, '$username',"
        ." $subscriber_id_users, '$subscriber_username', $insert_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);
    return $mysqli->insert_id;

}

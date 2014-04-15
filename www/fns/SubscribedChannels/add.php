<?php

namespace SubscribedChannels;

function add ($mysqli, $id_channels, $channel_name, $publisher_id_users,
    $publisher_username, $subscriber_id_users, $subscriber_username,
    $public_subscriber) {

    $channel_name = $mysqli->real_escape_string($channel_name);
    $publisher_username = $mysqli->real_escape_string($publisher_username);
    $subscriber_username = $mysqli->real_escape_string($subscriber_username);
    $public_subscriber = $public_subscriber ? '1' : '0';
    $insert_time = time();

    $sql = 'insert into subscribed_channels'
        .' (id_channels, channel_name, publisher_id_users,'
        .' publisher_username, subscriber_id_users,'
        .' subscriber_username, public_subscriber, insert_time)'
        ." values ($id_channels, '$channel_name', $publisher_id_users,"
        ." '$publisher_username', $subscriber_id_users,"
        ." '$subscriber_username', $public_subscriber, $insert_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);
    return $mysqli->insert_id;

}

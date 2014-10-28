<?php

namespace SubscribedChannels;

function add ($mysqli, $id_channels, $channel_name,
    $channel_public, $publisher_id_users, $publisher_username,
    $publisher_locked, $subscriber_id_users, $subscriber_username,
    $subscriber_locked, $receive_notifications, $insertApiKey) {

    $lowercase_name = strtolower($channel_name);
    $lowercase_name = $mysqli->real_escape_string($lowercase_name);

    $channel_name = $mysqli->real_escape_string($channel_name);
    $channel_public = $channel_public ? '1' : '0';
    $publisher_username = $mysqli->real_escape_string($publisher_username);
    $publisher_locked = $publisher_locked ? '1' : '0';
    $subscriber_username = $mysqli->real_escape_string($subscriber_username);
    $subscriber_locked = $subscriber_locked ? '1' : '0';
    $receive_notifications = $receive_notifications ? '1' : '0';
    $insert_time = time();
    if ($insertApiKey === null) {
        $insert_api_key_id = $insert_api_key_name = 'null';
    } else {

        $insert_api_key_id = $insertApiKey->id;

        $name = $insertApiKey->name;
        $insert_api_key_name = "'".$mysqli->real_escape_string($name)."'";

    }

    $sql = 'insert into subscribed_channels'
        .' (id_channels, channel_name, lowercase_name,'
        .' channel_public, publisher_id_users, publisher_username,'
        .' publisher_locked, subscriber_id_users, subscriber_username,'
        .' subscriber_locked, receive_notifications, insert_time,'
        .' insert_api_key_id, insert_api_key_name)'
        ." values ($id_channels, '$channel_name', '$lowercase_name',"
        ." $channel_public, $publisher_id_users, '$publisher_username',"
        ." $publisher_locked, $subscriber_id_users, '$subscriber_username',"
        ." $subscriber_locked, $receive_notifications, $insert_time,"
        ." $insert_api_key_id, $insert_api_key_name)";
    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}

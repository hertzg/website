<?php

namespace Channels;

function add ($mysqli, $id_users, $username,
    $channel_name, $public, $receive_notifications, $insertApiKey) {

    $lowercase_name = strtolower($channel_name);

    $username = $mysqli->real_escape_string($username);
    $channel_name = $mysqli->real_escape_string($channel_name);
    $lowercase_name = $mysqli->real_escape_string($lowercase_name);
    $public = $public ? '1' : '0';
    $receive_notifications = $receive_notifications ? '1' : '0';
    $insert_time = $update_time = time();
    if ($insertApiKey === null) {
        $insert_api_key_id = $insert_api_key_name = 'null';
    } else {

        $insert_api_key_id = $insertApiKey->id;

        $name = $insertApiKey->name;
        $insert_api_key_name = "'".$mysqli->real_escape_string($name)."'";

    }

    $sql = 'insert into channels (id_users, username, channel_name,'
        .' lowercase_name, public, receive_notifications, insert_time,'
        .' update_time, insert_api_key_id, insert_api_key_name)'
        ." values ($id_users, '$username', '$channel_name',"
        ." '$lowercase_name', $public, $receive_notifications, $insert_time,"
        ." $update_time, $insert_api_key_id, $insert_api_key_name)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}

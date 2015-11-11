<?php

namespace Channels;

function edit ($mysqli, $id, $channel_name,
    $public, $receive_notifications, $updateApiKey) {

    $lowercase_name = strtolower($channel_name);

    $channel_name = $mysqli->real_escape_string($channel_name);
    $lowercase_name = $mysqli->real_escape_string($lowercase_name);
    $public = $public ? '1' : '0';
    $receive_notifications = $receive_notifications ? '1' : '0';
    $update_time = time();
    if ($updateApiKey === null) {
        $update_api_key_id = $update_api_key_name = 'null';
    } else {

        $update_api_key_id = $updateApiKey->id;

        $name = $updateApiKey->name;
        $update_api_key_name = "'".$mysqli->real_escape_string($name)."'";

    }

    $sql = "update channels set channel_name = '$channel_name',"
        ." lowercase_name = '$lowercase_name', public = $public,"
        ." receive_notifications = $receive_notifications,"
        ." update_time = $update_time, update_api_key_id = $update_api_key_id,"
        ." update_api_key_name = $update_api_key_name,"
        ." revision = revision + 1 where id = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}

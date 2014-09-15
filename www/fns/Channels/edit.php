<?php

namespace Channels;

function edit ($mysqli, $id, $channel_name, $public, $receive_notifications) {

    $lowercase_name = strtolower($channel_name);
    $lowercase_name = $mysqli->real_escape_string($lowercase_name);

    $channel_name = $mysqli->real_escape_string($channel_name);
    $lowercase_name = strtolower($channel_name);
    $public = $public ? '1' : '0';
    $receive_notifications = $receive_notifications ? '1' : '0';
    $update_time = time();

    $sql = "update channels set channel_name = '$channel_name',"
        ." lowercase_name = '$lowercase_name', public = $public,"
        ." receive_notifications = $receive_notifications,"
        ." update_time = $update_time, num_edits = num_edits + 1"
        ." where id = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}

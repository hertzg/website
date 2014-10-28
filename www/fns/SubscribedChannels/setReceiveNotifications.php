<?php

namespace SubscribedChannels;

function setReceiveNotifications ($mysqli,
    $id, $receive_notifications, $updateApiKey) {

    $receive_notifications = $receive_notifications ? '1' : '0';
    $update_time = time();
    if ($updateApiKey === null) {
        $update_api_key_id = $update_api_key_name = 'null';
    } else {

        $update_api_key_id = $updateApiKey->id;

        $name = $updateApiKey->name;
        $update_api_key_name = "'".$mysqli->real_escape_string($name)."'";

    }

    $sql = 'update subscribed_channels set'
        ." receive_notifications = $receive_notifications,"
        ." update_time = $update_time, update_api_key_id = $update_api_key_id,"
        ." update_api_key_name = $update_api_key_name where id = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}

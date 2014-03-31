<?php

namespace Notifications;

function addExternal ($mysqli, $id_users, $id_channels, $channel_name,
    $notification_text, $id_subscribed_channels) {
    $channel_name = $mysqli->real_escape_string($channel_name);
    $notification_text = $mysqli->real_escape_string($notification_text);
    $insert_time = time();
    $sql = 'insert into notifications'
        .' (id_users, id_channels, channel_name,'
        .' notification_text, insert_time, id_subscribed_channels)'
        ." values ($id_users, $id_channels, '$channel_name',"
        ." '$notification_text', $insert_time, $id_subscribed_channels)";
    $mysqli->query($sql);
}

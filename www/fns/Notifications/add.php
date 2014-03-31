<?php

namespace Notifications;

function add ($mysqli, $id_users, $id_channels, $channel_name, $notification_text) {
    $channel_name = $mysqli->real_escape_string($channel_name);
    $notification_text = $mysqli->real_escape_string($notification_text);
    $insert_time = time();
    $sql = 'insert into notifications'
        .' (id_users, id_channels, channel_name,'
        .' notification_text, insert_time)'
        ." values ($id_users, $id_channels, '$channel_name',"
        ." '$notification_text', $insert_time)";
    $mysqli->query($sql);
}

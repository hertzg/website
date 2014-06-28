<?php

namespace Notifications;

function addOnChannel ($mysqli, $id_users, $id_channels, $channel_name, $text) {

    $channel_name = $mysqli->real_escape_string($channel_name);
    $text = $mysqli->real_escape_string($text);
    $insert_time = time();

    $sql = 'insert into notifications'
        .' (id_users, id_channels, channel_name,'
        .' text, insert_time)'
        ." values ($id_users, $id_channels, '$channel_name',"
        ." '$text', $insert_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}

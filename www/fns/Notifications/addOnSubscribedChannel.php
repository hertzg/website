<?php

namespace Notifications;

function addOnSubscribedChannel ($mysqli, $id_users, $channel_name,
    $text, $id_subscribed_channels) {

    $channel_name = $mysqli->real_escape_string($channel_name);
    $text = $mysqli->real_escape_string($text);
    $insert_time = time();

    $sql = 'insert into notifications'
        .' (id_users, channel_name, text,'
        .' insert_time, id_subscribed_channels)'
        ." values ($id_users, '$channel_name', '$text',"
        ." $insert_time, $id_subscribed_channels)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}

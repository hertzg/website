<?php

namespace Notifications;

function addOnChannel ($mysqli, $id_users,
    $id_channels, $channel_name, $text, $insertApiKey) {

    $channel_name = $mysqli->real_escape_string($channel_name);
    $text = $mysqli->real_escape_string($text);
    $insert_time = time();
    if ($insertApiKey === null) {
        $insert_api_key_id = $insert_api_key_name = 'null';
    } else {

        $insert_api_key_id = $insertApiKey->id;

        $name = $insertApiKey->name;
        $insert_api_key_name = "'".$mysqli->real_escape_string($name)."'";

    }

    $sql = 'insert into notifications'
        .' (id_users, id_channels, channel_name,'
        .' text, insert_time, insert_api_key_id, insert_api_key_name)'
        ." values ($id_users, $id_channels, '$channel_name',"
        ." '$text', $insert_time, $insert_api_key_id, $insert_api_key_name)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}

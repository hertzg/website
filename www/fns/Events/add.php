<?php

namespace Events;

function add ($mysqli, $id_users, $text, $event_time,
    $start_hour, $start_minute, $insertApiKey) {

    $text = $mysqli->real_escape_string($text);
    if ($start_hour === null) $start_hour = $start_minute = 'null';
    $insert_time = $update_time = time();
    if ($insertApiKey === null) {
        $insert_api_key_id = $insert_api_key_name = 'null';
    } else {

        $insert_api_key_id = $insertApiKey->id;

        $name = $insertApiKey->name;
        $insert_api_key_name = "'".$mysqli->real_escape_string($name)."'";

    }

    $sql = 'insert into events'
        .' (id_users, text, event_time,'
        .' start_hour, start_minute, insert_time,'
        .' update_time, insert_api_key_id, insert_api_key_name)'
        ." values ($id_users, '$text', $event_time,"
        ." $start_hour, $start_minute, $insert_time,"
        ." $update_time, $insert_api_key_id, $insert_api_key_name)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}

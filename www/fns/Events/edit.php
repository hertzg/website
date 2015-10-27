<?php

namespace Events;

function edit ($mysqli, $id, $event_time,
    $start_hour, $start_minute, $text, $updateApiKey) {

    $text = $mysqli->real_escape_string($text);
    if ($start_hour === null) $start_hour = 'null';
    if ($start_minute === null) $start_minute = 'null';
    $update_time = time();
    if ($updateApiKey === null) {
        $update_api_key_id = $update_api_key_name = 'null';
    } else {

        $update_api_key_id = $updateApiKey->id;

        $name = $updateApiKey->name;
        $update_api_key_name = "'".$mysqli->real_escape_string($name)."'";

    }

    $sql = "update events set event_time = $event_time,"
        ." start_hour = $start_hour, start_minute = $start_minute,"
        ." text = '$text', update_time = $update_time,"
        ." update_api_key_id = $update_api_key_id,"
        ." update_api_key_name = $update_api_key_name,"
        ." revision = revision + 1 where id = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}

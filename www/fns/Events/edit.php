<?php

namespace Events;

function edit ($mysqli, $id_users, $id, $event_time, $text) {
    $text = $mysqli->real_escape_string($text);
    $update_time = time();
    $sql = "update events set event_time = $event_time,"
        ." text = '$text', update_time = $update_time,"
        ." revision = revision + 1 where id_users = $id_users"
        ." and id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

<?php

namespace Events;

function edit ($mysqli, $id_users, $id, $event_time, $event_text) {
    $event_text = $mysqli->real_escape_string($event_text);
    $update_time = time();
    $sql = "update events set event_time = $event_time,"
        ." event_text = '$event_text', update_time = $update_time"
        ." where id_users = $id_users and id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

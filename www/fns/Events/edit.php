<?php

namespace Events;

function edit ($mysqli, $id_users, $id, $event_text) {
    $event_text = $mysqli->real_escape_string($event_text);
    $update_time = time();
    $sql = 'update events set'
        ." event_text = '$event_text', update_time = $update_time"
        ." where id_users = $id_users and id_events = $id";
    $mysqli->query($sql);
}

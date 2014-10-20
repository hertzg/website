<?php

namespace Events;

function edit ($mysqli, $id, $event_time, $text) {
    $text = $mysqli->real_escape_string($text);
    $update_time = time();
    $sql = "update events set event_time = $event_time,"
        ." text = '$text', update_time = $update_time,"
        ." revision = revision + 1 where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

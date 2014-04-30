<?php

namespace Schedules;

function edit ($mysqli, $id, $text, $time_interval, $time_offset) {
    $text = $mysqli->real_escape_string($text);
    $update_time = time();
    $sql = "update schedules set text = '$text',"
        ." time_interval = $time_interval, time_offset = $time_offset,"
        ." update_time = $update_time where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

<?php

namespace Schedules;

function edit ($mysqli, $id, $text, $day_interval, $day_offset, $start_day) {
    $text = $mysqli->real_escape_string($text);
    $update_time = time();
    $sql = "update schedules set text = '$text',"
        ." day_interval = $day_interval, day_offset = $day_offset,"
        ." start_day = $start_day, update_time = $update_time where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

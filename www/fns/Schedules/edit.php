<?php

namespace Schedules;

function edit ($mysqli, $id, $text, $time_interval) {
    $text = $mysqli->real_escape_string($text);
    $sql = "update schedules set text = '$text',"
        ." time_interval = $time_interval where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

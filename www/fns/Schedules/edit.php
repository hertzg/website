<?php

namespace Schedules;

function edit ($mysqli, $id, $text, $interval, $offset) {

    $text = $mysqli->real_escape_string($text);
    $update_time = time();

    $sql = "update schedules set text = '$text',"
        ." `interval` = $interval, offset = $offset,"
        ." update_time = $update_time, revision = revision + 1"
        ." where id = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}

<?php

namespace Schedules;

function edit ($mysqli, $id, $text) {
    $text = $mysqli->real_escape_string($text);
    $sql = "update schedules set text = '$text' where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

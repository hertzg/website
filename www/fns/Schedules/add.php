<?php

namespace Schedules;

function add ($mysqli, $id_users, $text, $time_interval, $time_offset) {
    $text = $mysqli->real_escape_string($text);
    $sql = 'insert into schedules (id_users, text, time_interval, time_offset)'
        ." values ($id_users, '$text', $time_interval, $time_offset)";
    $mysqli->query($sql) || trigger_error($mysqli->error);
    return $mysqli->insert_id;
}

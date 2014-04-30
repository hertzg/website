<?php

namespace Schedules;

function add ($mysqli, $id_users, $text, $time_interval) {
    $text = $mysqli->real_escape_string($text);
    $sql = 'insert into schedules (id_users, text, time_interval)'
        ." values ($id_users, '$text', $time_interval)";
    $mysqli->query($sql) || trigger_error($mysqli->error);
    return $mysqli->insert_id;
}

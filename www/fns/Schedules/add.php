<?php

namespace Schedules;

function add ($mysqli, $id_users, $text, $interval, $offset) {
    $text = $mysqli->real_escape_string($text);
    $insert_time = $update_time = time();
    $sql = 'insert into schedules (id_users, text, `interval`,'
        .' offset, insert_time, update_time)'
        ." values ($id_users, '$text', $interval,"
        ." $offset, $insert_time, $update_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);
    return $mysqli->insert_id;
}

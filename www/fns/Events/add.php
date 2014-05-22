<?php

namespace Events;

function add ($mysqli, $id_users, $text, $event_time) {
    $text = $mysqli->real_escape_string($text);
    $insert_time = $update_time = time();
    $sql = 'insert into events'
        .' (id_users, text, event_time,'
        .' insert_time, update_time)'
        ." values ($id_users, '$text', $event_time,"
        ." $insert_time, $update_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);
    return $mysqli->insert_id;
}

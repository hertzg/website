<?php

namespace Events;

function add ($mysqli, $id_users, $event_text, $event_time) {
    $event_text = $mysqli->real_escape_string($event_text);
    $insert_time = $update_time = time();
    $sql = 'insert into events'
        .' (id_users, event_text, event_time,'
        .' insert_time, update_time)'
        ." values ($id_users, '$event_text', $event_time,"
        ." $insert_time, $update_time)";
    $mysqli->query($sql);
    return $mysqli->insert_id;
}

<?php

namespace Events;

function add ($mysqli, $idusers, $eventtext, $eventtime) {
    $eventtext = $mysqli->real_escape_string($eventtext);
    $insert_time = $update_time = time();
    $sql = 'insert into events'
        .' (idusers, eventtext, eventtime,'
        .' insert_time, update_time)'
        ." values ($idusers, '$eventtext', $eventtime,"
        ." $insert_time, $update_time)";
    $mysqli->query($sql);
    return $mysqli->insert_id;
}

<?php

namespace Events;

function add ($mysqli, $idusers, $eventtext, $eventtime) {
    $eventtext = $mysqli->real_escape_string($eventtext);
    $inserttime = time();
    $sql = 'insert into events'
        .' (idusers, eventtext, eventtime, inserttime)'
        ." values ($idusers, '$eventtext', $eventtime, $inserttime)";
    $mysqli->query($sql);
    return $mysqli->insert_id;
}

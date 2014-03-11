<?php

namespace Events;

function edit ($mysqli, $idusers, $id, $eventtext) {
    $eventtext = $mysqli->real_escape_string($eventtext);
    $update_time = time();
    $sql = 'update events set'
        ." eventtext = '$eventtext',"
        ." update_time = $update_time"
        ." where idusers = $idusers and idevents = $id";
    $mysqli->query($sql);
}

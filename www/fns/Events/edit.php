<?php

namespace Events;

function edit ($mysqli, $idusers, $id, $eventtext) {
    $eventtext = $mysqli->real_escape_string($eventtext);
    $edittime = time();
    $sql = 'update events set'
        ." eventtext = '$eventtext',"
        ." edittime = $edittime"
        ." where idusers = $idusers and idevents = $id";
    $mysqli->query($sql);
}

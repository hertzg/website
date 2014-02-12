<?php

namespace Events;

function edit ($mysqli, $idusers, $id, $eventtext) {
    $eventtext = mysqli_real_escape_string($mysqli, $eventtext);
    $edittime = time();
    return mysqli_query(
        $mysqli,
        'update events set'
        ." eventtext = '$eventtext',"
        ." edittime = $edittime"
        ." where idusers = $idusers and idevents = $id"
    );
}

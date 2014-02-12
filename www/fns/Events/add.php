<?php

namespace Events;

function add ($mysqli, $idusers, $eventtext, $eventtime) {
    $eventtext = mysqli_real_escape_string($mysqli, $eventtext);
    $inserttime = time();
    mysqli_query(
        $mysqli,
        'insert into events'
        .' (idusers, eventtext, eventtime, inserttime)'
        ." values ($idusers, '$eventtext', $eventtime, $inserttime)"
    );
    return mysqli_insert_id($mysqli);
}

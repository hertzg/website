<?php

namespace Events;

function index ($mysqli, $idusers, $eventtime) {
    $sql = 'select * from events'
        ." where idusers = $idusers and eventtime = $eventtime";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}

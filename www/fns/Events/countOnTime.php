<?php

namespace Events;

function countOnTime ($mysqli, $idusers, $eventtime) {
    $sql = 'select count(*) count from events'
        ." where idusers = $idusers and eventtime = $eventtime";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql)->count;
}

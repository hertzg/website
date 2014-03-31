<?php

namespace Events;

function countOnTime ($mysqli, $id_users, $event_time) {
    $sql = 'select count(*) count from events'
        ." where id_users = $id_users and event_time = $event_time";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql)->count;
}

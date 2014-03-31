<?php

namespace Events;

function indexOnUserAndTime ($mysqli, $id_users, $event_time) {
    $sql = 'select * from events'
        ." where id_users = $id_users and event_time = $event_time";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}

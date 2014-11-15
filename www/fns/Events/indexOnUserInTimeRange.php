<?php

namespace Events;

function indexOnUserInTimeRange ($mysqli,
    $id_users, $from_event_time, $to_event_time) {

    $sql = "select * from events where id_users = $id_users"
        ." and event_time >= $from_event_time and event_time < $to_event_time";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}

<?php

namespace Events;

function indexOnUser ($mysqli, $id_users) {
    $sql = "select * from events where id_users = $id_users order by event_time";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}

<?php

namespace Schedules;

function indexOnUser ($mysqli, $id_users) {
    $sql = "select * from schedules where id_users = $id_users"
        .' order by update_time';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}

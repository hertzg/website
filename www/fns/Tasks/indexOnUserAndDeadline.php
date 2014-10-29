<?php

namespace Tasks;

function indexOnUserAndDeadline ($mysqli, $id_users, $deadline_time) {
    $sql = "select * from tasks where id_users = $id_users"
        ." and deadline_time = $deadline_time"
        .' order by top_priority desc, update_time desc';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}

<?php

namespace Tasks;

function indexOnUserInDeadlineRange ($mysqli,
    $id_users, $from_deadline_time, $to_deadline_time) {

    $sql = "select * from tasks where id_users = $id_users"
        ." and deadline_time >= $from_deadline_time"
        ." and deadline_time < $to_deadline_time";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}

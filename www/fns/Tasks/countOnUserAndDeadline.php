<?php

namespace Tasks;

function countOnUserAndDeadline ($mysqli, $id_users, $deadline_time) {
    $sql = 'select count(*) count from tasks'
        ." where id_users = $id_users and deadline_time = $deadline_time";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql)->count;
}

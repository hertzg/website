<?php

namespace Tasks;

function get ($mysqli, $id_users, $id) {
    $sql = 'select * from tasks'
        ." where id_users = $id_users and id_tasks = $id";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_single_object($mysqli, $sql);
}

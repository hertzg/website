<?php

namespace Tasks;

function indexOnUser ($mysqli, $id_users) {
    $sql = "select * from tasks where id_users = $id_users"
        .' order by top_priority desc, update_time desc';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}

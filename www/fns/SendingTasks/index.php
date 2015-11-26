<?php

namespace SendingTasks;

function index ($mysqli) {
    $sql = 'select * from sending_tasks order by num_fails, insert_time';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}

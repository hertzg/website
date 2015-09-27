<?php

namespace Users;

function index ($mysqli) {
    $sql = 'select * from users order by insert_time desc';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}

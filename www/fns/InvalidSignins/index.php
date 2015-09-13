<?php

namespace InvalidSignins;

function index ($mysqli) {
    $sql = 'select * from invalid_signins order by insert_time desc';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}

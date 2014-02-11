<?php

namespace Tasks;

function index ($mysqli, $idusers) {
    $sql = "select * from tasks where idusers = $idusers"
        .' order by done, updatetime desc';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}

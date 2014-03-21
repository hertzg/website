<?php

namespace Tasks;

function indexOnUser ($mysqli, $idusers, $offset, $limit, &$total) {

    $sql = "select count(*) total from tasks where idusers = $idusers";
    include_once __DIR__.'/../mysqli_single_object.php';
    $total = mysqli_single_object($mysqli, $sql)->total;

    $sql = "select * from tasks where idusers = $idusers"
        .' order by top_priority desc, update_time desc'
        ." limit $limit offset $offset";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}

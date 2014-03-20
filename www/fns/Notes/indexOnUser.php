<?php

namespace Notes;

function indexOnUser ($mysqli, $idusers, $offset, $limit, &$total) {

    $sql = "select count(*) total from notes where idusers = $idusers";
    include_once __DIR__.'/../mysqli_single_object.php';
    $total = mysqli_single_object($mysqli, $sql)->total;

    $sql = "select * from notes where idusers = $idusers"
        ." order by updatetime desc limit $limit offset $offset";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}


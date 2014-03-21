<?php

namespace Contacts;

function indexOnUser ($mysqli, $idusers, $offset, $limit, &$total) {

    $sql = "select count(*) total from contacts where idusers = $idusers";
    include_once __DIR__.'/../mysqli_single_object.php';
    $total = mysqli_single_object($mysqli, $sql)->total;

    $sql = "select * from contacts where idusers = $idusers"
        ." order by full_name limit $limit offset $offset";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}

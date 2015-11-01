<?php

namespace AdminConnections;

function indexPage ($mysqli, $offset, $limit, &$total) {

    $fnsDir = __DIR__.'/..';

    $from = 'from admin_connections';

    $sql = "select count(*) total $from";
    include_once "$fnsDir/mysqli_single_object.php";
    $total = mysqli_single_object($mysqli, $sql)->total;

    if ($offset >= $total) return [];

    $sql = "select * $from order by address, insert_time"
        ." limit $limit offset $offset";
    include_once "$fnsDir/mysqli_query_object.php";
    return mysqli_query_object($mysqli, $sql);

}

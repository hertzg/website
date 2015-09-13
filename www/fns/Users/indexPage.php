<?php

namespace Users;

function indexPage ($mysqli, $offset, $limit, &$total) {

    $fnsDir = __DIR__.'/..';

    $from = 'from users';

    $sql = "select count(*) total $from";
    include_once "$fnsDir/mysqli_single_object.php";
    $total = mysqli_single_object($mysqli, $sql)->total;

    if ($offset >= $total) return [];

    $sql = "select * $from order by insert_time desc"
        ." limit $limit offset $offset";
    include_once "$fnsDir/mysqli_query_object.php";
    return mysqli_query_object($mysqli, $sql);

}

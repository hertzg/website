<?php

namespace AdminApiKeys;

function indexPage ($mysqli, $offset, $limit, &$total, $order_by) {

    $fnsDir = __DIR__.'/..';

    $from = 'from admin_api_keys';

    $sql = "select count(*) total $from";
    include_once "$fnsDir/mysqli_single_object.php";
    $total = mysqli_single_object($mysqli, $sql)->total;

    if ($offset >= $total) return [];

    $sql = "select * $from order by $order_by"
        ." limit $limit offset $offset";
    include_once "$fnsDir/mysqli_query_object.php";
    return mysqli_query_object($mysqli, $sql);

}

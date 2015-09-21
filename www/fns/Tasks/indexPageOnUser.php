<?php

namespace Tasks;

function indexPageOnUser ($mysqli, $id_users,
    $offset, $limit, &$total, $order_by) {

    $fnsDir = __DIR__.'/..';

    $fromWhere = "from tasks where id_users = $id_users";

    $sql = "select count(*) total $fromWhere";
    include_once "$fnsDir/mysqli_single_object.php";
    $total = mysqli_single_object($mysqli, $sql)->total;

    if ($offset >= $total) return [];

    $sql = "select * $fromWhere order by top_priority desc, $order_by"
        ." limit $limit offset $offset";
    include_once "$fnsDir/mysqli_query_object.php";
    return mysqli_query_object($mysqli, $sql);

}

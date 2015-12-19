<?php

namespace Calculations;

function searchPage ($mysqli, $id_users,
    $keyword, $offset, $limit, &$total, $order_by) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/escape_like.php";
    $keyword = escape_like($keyword);
    $keyword = $mysqli->real_escape_string($keyword);

    $fromWhere = "from calculations where id_users = $id_users"
        ." and title like '%$keyword%'";

    $sql = "select count(*) total $fromWhere";
    include_once "$fnsDir/mysqli_single_object.php";
    $total = mysqli_single_object($mysqli, $sql)->total;

    if ($offset >= $total) return [];

    $sql = "select * $fromWhere order by $order_by"
        ." limit $limit offset $offset";
    include_once "$fnsDir/mysqli_query_object.php";
    return mysqli_query_object($mysqli, $sql);

}

<?php

namespace AdminConnectionAuths;

function searchPageOnAdminConnection ($mysqli,
    $id_admin_connections, $keyword, $offset, $limit, &$total) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/escape_like.php";
    $keyword = escape_like($keyword);
    $keyword = $mysqli->real_escape_string($keyword);

    $fromWhere = 'from admin_connection_auths'
        ." where id_admin_connections = $id_admin_connections"
        ." and (remote_address like '%$keyword%' or method like '%$keyword%')";

    $sql = "select count(*) total $fromWhere";
    include_once "$fnsDir/mysqli_single_object.php";
    $total = mysqli_single_object($mysqli, $sql)->total;

    if ($offset >= $total) return [];

    $sql = "select * $fromWhere order by insert_time desc"
        ." limit $limit offset $offset";
    include_once "$fnsDir/mysqli_query_object.php";
    return mysqli_query_object($mysqli, $sql);

}

<?php

namespace AdminConnections;

function searchPage ($mysqli, $includes, $excludes, $offset, $limit, &$total) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/escape_like.php";
    $fromWhere = 'from admin_connections where 1';
    foreach ($includes as $include) {
        $include = $mysqli->real_escape_string(escape_like($include));
        $fromWhere .= " and address like '%$include%'";
    }
    foreach ($excludes as $exclude) {
        $exclude = $mysqli->real_escape_string(escape_like($exclude));
        $fromWhere .= " and address not like '%$exclude%'";
    }

    $sql = "select count(*) total $fromWhere";
    include_once "$fnsDir/mysqli_single_object.php";
    $total = mysqli_single_object($mysqli, $sql)->total;

    if ($offset >= $total) return [];

    $sql = "select * $fromWhere order by address, insert_time"
        ." limit $limit offset $offset";
    include_once "$fnsDir/mysqli_query_object.php";
    return mysqli_query_object($mysqli, $sql);

}

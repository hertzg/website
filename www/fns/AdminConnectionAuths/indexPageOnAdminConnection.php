<?php

namespace AdminConnectionAuths;

function indexPageOnAdminConnection ($mysqli,
    $id_admin_connections, $offset, $limit, &$total) {

    $fnsDir = __DIR__.'/..';

    $fromWhere = 'from admin_connection_auths'
        ." where id_admin_connections = $id_admin_connections";

    $sql = "select count(*) total $fromWhere";
    include_once "$fnsDir/mysqli_single_object.php";
    $total = mysqli_single_object($mysqli, $sql)->total;

    if ($offset >= $total) return [];

    $sql = "select * $fromWhere order by insert_time desc"
        ." limit $limit offset $offset";
    include_once "$fnsDir/mysqli_query_object.php";
    return mysqli_query_object($mysqli, $sql);

}

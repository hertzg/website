<?php

namespace Notifications;

function indexPageOnUserChannel ($mysqli, $id_users,
    $id_channels, $offset, $limit, &$total) {

    $fromWhere = "from notifications where id_users = $id_users"
        ." and id_channels = $id_channels";

    $sql = "select count(*) total $fromWhere";
    include_once __DIR__.'/../mysqli_single_object.php';
    $total = mysqli_single_object($mysqli, $sql)->total;

    $sql = "select * $fromWhere order by insert_time"
        ." limit $limit offset $offset";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}

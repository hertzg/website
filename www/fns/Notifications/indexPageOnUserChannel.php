<?php

namespace Notifications;

function indexPageOnUserChannel ($mysqli, $id_users,
    $id_channels, $offset, $limit, &$total) {

    $sql = 'select count(*) total from notifications'
        ." where id_users = $id_users and id_channels = $id_channels";
    include_once __DIR__.'/../mysqli_single_object.php';
    $total = mysqli_single_object($mysqli, $sql)->total;

    $sql = 'select * from notifications'
        ." where id_users = $id_users and id_channels = $id_channels"
        ." order by insert_time limit $limit offset $offset";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}

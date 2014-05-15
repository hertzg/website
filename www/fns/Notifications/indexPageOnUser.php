<?php

namespace Notifications;

function indexPageOnUser ($mysqli, $id_users, $offset, $limit, &$total) {

    $sql = 'select count(*) total from notifications'
        ." where id_users = $id_users";
    include_once __DIR__.'/../mysqli_single_object.php';
    $total = mysqli_single_object($mysqli, $sql)->total;

    $sql = "select * from notifications where id_users = $id_users"
        ." order by insert_time desc limit $limit offset $offset";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}

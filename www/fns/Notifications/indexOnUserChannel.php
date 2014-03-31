<?php

namespace Notifications;

function indexOnUserChannel ($mysqli, $id_users, $id_channels) {
    $sql = 'select * from notifications'
        ." where id_users = $id_users and id_channels = $id_channels"
        .' order by insert_time';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}

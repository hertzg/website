<?php

namespace Notifications;

function indexOnUser ($mysqli, $id_users) {
    $sql = 'select * from notifications'
        ." where id_users = $id_users"
        .' order by insert_time desc';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}

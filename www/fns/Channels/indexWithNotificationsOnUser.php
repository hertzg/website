<?php

namespace Channels;

function indexWithNotificationsOnUser ($mysqli, $id_users) {
    $sql = "select * from channels where id_users = $id_users"
        ." and num_notifications > 0 order by lowercase_name";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}

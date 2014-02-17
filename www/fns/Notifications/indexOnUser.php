<?php

namespace Notifications;

function indexOnUser ($mysqli, $idusers) {
    $sql = 'select * from notifications'
        ." where idusers = $idusers"
        .' order by inserttime desc';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}

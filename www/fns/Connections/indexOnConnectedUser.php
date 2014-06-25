<?php

namespace Connections;

function indexOnConnectedUser ($mysqli, $connected_id_users) {
    $sql = 'select * from connections'
        ." where connected_id_users = $connected_id_users";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}

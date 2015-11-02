<?php

namespace Connections;

function indexOnUser ($mysqli, $id_users) {
    $sql = "select * from connections where id_users = $id_users"
        .' order by username, address';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}

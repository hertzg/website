<?php

namespace Tokens;

function indexOnUser ($mysqli, $id_users) {
    $sql = "select * from tokens where id_users = $id_users"
        .' order by insert_time';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}

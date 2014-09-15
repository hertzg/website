<?php

namespace Channels;

function indexOnUser ($mysqli, $id_users) {
    $sql = "select * from channels where id_users = $id_users"
        .' order by lowercase_name';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}

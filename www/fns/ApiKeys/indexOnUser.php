<?php

namespace ApiKeys;

function indexOnUser ($mysqli, $id_users, $order_by) {
    $sql = "select * from api_keys where id_users = $id_users"
        ." order by $order_by, insert_time";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}

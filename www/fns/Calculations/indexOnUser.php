<?php

namespace Calculations;

function indexOnUser ($mysqli, $id_users) {
    $sql = "select * from calculations where id_users = $id_users"
        .' order by update_time desc';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}

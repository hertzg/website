<?php

namespace DeletedItems;

function indexOnUser ($mysqli, $id_users) {
    $sql = "select * from deleted_items where id_users = $id_users";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}

<?php

namespace DeletedItems;

function getOnUser ($mysqli, $id_users, $id) {
    $sql = 'select * from deleted_items'
        ." where id_users = $id_users and id = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}

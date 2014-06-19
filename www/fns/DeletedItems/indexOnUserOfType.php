<?php

namespace DeletedItems;

function indexOnUserOfType ($mysqli, $id_users, $data_type) {
    $sql = 'select * from deleted_items'
        ." where id_users = $id_users and data_type = '$data_type'";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}

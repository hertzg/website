<?php

namespace Files\Committed;

function indexInUserFolder ($mysqli, $id_users, $id_folders) {
    $sql = "select * from files where committed = 1 and id_users = $id_users"
        ." and id_folders = $id_folders order by name";
    include_once __DIR__.'/../../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}

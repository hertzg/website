<?php

namespace Files;

function indexInUserFolder ($mysqli, $id_users, $id_folders) {
    $sql = 'select * from files'
        ." where id_users = $id_users and id_folders = $id_folders"
        .' order by file_name';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}

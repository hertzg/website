<?php

namespace Folders;

function indexInUserFolder ($mysqli, $id_users, $parent_id_folders) {
    $sql = 'select * from folders'
        ." where id_users = $id_users and parent_id_folders = $parent_id_folders"
        .' order by name';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}

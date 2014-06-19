<?php

namespace DeletedFiles;

function indexOnParent ($mysqli, $id_users, $parent_id) {
    $sql = 'select * from deleted_files'
        ." where id_users = $id_users and parent_id = $parent_id";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}

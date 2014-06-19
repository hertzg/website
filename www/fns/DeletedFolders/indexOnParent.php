<?php

namespace DeletedFolders;

function indexOnParent ($mysqli, $id_users, $parent_id_folders) {
    $sql = "select * from deleted_folders where id_users = $id_users"
        ." and parent_id_folders = $parent_id_folders";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}

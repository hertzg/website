<?php

namespace DeletedFiles;

function indexOnParent ($mysqli, $id_users, $id_folders) {
    $sql = 'select * from deleted_files'
        ." where id_users = $id_users and id_folders = $id_folders";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}

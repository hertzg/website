<?php

namespace Folders;

function get ($mysqli, $id_users, $id_folders) {
    $sql = 'select * from folders'
        ." where id_users = $id_users and id_folders = $id_folders";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}

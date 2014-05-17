<?php

namespace Folders;

function getByName ($mysqli, $id_users, $parent_id_folders, $name,
    $excludeid_folders = 0) {

    $name = $mysqli->real_escape_string($name);

    $sql = 'select * from folders'
        ." where id_users = $id_users"
        ." and parent_id_folders = $parent_id_folders"
        ." and name = '$name'"
        ." and id_folders != $excludeid_folders";

    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);

}

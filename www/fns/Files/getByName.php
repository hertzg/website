<?php

namespace Files;

function getByName ($mysqli, $id_users, $id_folders, $name, $exclude_id = 0) {
    $name = $mysqli->real_escape_string($name);
    $sql = 'select * from files'
        ." where id_users = $id_users and id_folders = $id_folders"
        ." and name = '$name' and id_files != $exclude_id";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}

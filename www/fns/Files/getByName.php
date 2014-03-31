<?php

namespace Files;

function getByName ($mysqli, $id_users, $id_folders, $file_name, $excludeid = 0) {
    $file_name = $mysqli->real_escape_string($file_name);
    $sql = 'select * from files'
        ." where id_users = $id_users and id_folders = $id_folders"
        ." and file_name = '$file_name' and id_files != $excludeid";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}

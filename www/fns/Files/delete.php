<?php

namespace Files;

function delete ($mysqli, $id_users, $id) {

    $sql = "delete from files where id_users = $id_users and id_files = $id";
    $mysqli->query($sql);

    include_once __DIR__.'/filename.php';
    $filename = filename($id_users, $id);

    if (is_file($filename)) {

        $file_size = filesize($filename);
        unlink($filename);

        include_once __DIR__.'/../Users/addStorageUsed.php';
        \Users\addStorageUsed($mysqli, $id_users, -$file_size);

    }
}

<?php

namespace Files;

function delete ($mysqli, $id_users, $id) {

    $sql = "delete from files where id_users = $id_users and id_files = $id";
    $mysqli->query($sql);

    include_once __DIR__.'/filePath.php';
    $filePath = filePath($id_users, $id);

    if (is_file($filePath)) {

        $file_size = filesize($filePath);
        unlink($filePath);

        include_once __DIR__.'/../Users/addStorageUsed.php';
        \Users\addStorageUsed($mysqli, $id_users, -$file_size);

    }
}

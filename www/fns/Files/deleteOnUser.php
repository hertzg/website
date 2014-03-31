<?php

namespace Files;

function deleteOnUser ($mysqli, $id_users) {

    $sql = "select * from files where id_users = $id_users";

    include_once __DIR__.'/../mysqli_query_object.php';
    $files = mysqli_query_object($mysqli, $sql);

    if ($files) {
        include_once __DIR__.'/filename.php';
        foreach ($files as $file) {
            $filename = filename($id_users, $file->id_files);
            unlink($filename);
        }
    }

    $mysqli->query("delete from files where id_users = $id_users");

}

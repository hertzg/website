<?php

namespace Files;

function deleteOnUser ($mysqli, $id_users) {

    $sql = "select * from files where id_users = $id_users";

    include_once __DIR__.'/../mysqli_query_object.php';
    $files = mysqli_query_object($mysqli, $sql);

    if ($files) {
        include_once __DIR__.'/File/delete.php';
        foreach ($files as $file) {
            \Files\File\delete($id_users, $file->id_files);
        }
    }

    $sql = "delete from files where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}

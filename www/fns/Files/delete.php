<?php

namespace Files;

function delete ($mysqli, $id_users, $id) {

    $sql = "delete from files where id_users = $id_users and id_files = $id";
    $mysqli->query($sql);

    include_once __DIR__.'/filePath.php';
    $filePath = filePath($id_users, $id);

    if (is_file($filePath)) unlink($filePath);

}

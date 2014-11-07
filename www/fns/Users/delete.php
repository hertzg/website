<?php

namespace Users;

function delete ($mysqli, $id) {

    $sql = "delete from users where id_users = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);

    $rmdir = function ($dirname) {
        if (is_dir($dirname)) rmdir($dirname);
    };

    include_once __DIR__.'/Directory/path.php';
    $userDir = Directory\path($id);

    $rmdir("$userDir/files");
    $rmdir("$userDir/received-files");
    $rmdir("$userDir/received-folder-files");
    $rmdir($userDir);

}

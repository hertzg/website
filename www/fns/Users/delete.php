<?php

namespace Users;

function delete ($mysqli, $id_users) {

    $sql = "delete from users where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

    $rmdir = function ($dirname) {
        if (is_dir($dirname)) rmdir($dirname);
    };

    $userDir = __DIR__."/../../users/$id_users";
    $rmdir("$userDir/files");
    $rmdir("$userDir/received-files");
    $rmdir("$userDir/received-folder-files");
    $rmdir($userDir);

}

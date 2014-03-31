<?php

namespace Users;

function delete ($mysqli, $id_users) {
    $mysqli->query("delete from users where id_users = $id_users");
    $dirname = __DIR__."/../../users/$id_users";
    rmdir("$dirname/files");
    rmdir($dirname);
}

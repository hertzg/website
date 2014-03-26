<?php

namespace Users;

function delete ($mysqli, $idusers) {
    $mysqli->query("delete from users where idusers = $idusers");
    $dirname = __DIR__."/../../users/$idusers";
    rmdir("$dirname/files");
    rmdir($dirname);
}

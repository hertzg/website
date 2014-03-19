<?php

namespace Users;

function editPassword ($mysqli, $idusers, $password) {

    include_once __DIR__.'/../Password/hash.php';
    $password_hash = \Password\hash($password);
    $password_hash = $mysqli->real_escape_string($password_hash);

    $sql = "update users set password_hash = '$password_hash',"
        .' reset_password_key = null, reset_password_key_time = null'
        ." where idusers = $idusers";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}

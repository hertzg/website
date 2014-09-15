<?php

namespace Users;

function editPassword ($mysqli, $id, $password) {

    include_once __DIR__.'/../Password/hash.php';
    list($password_hash, $password_salt) = \Password\hash($password);

    $password_hash = $mysqli->real_escape_string($password_hash);
    $password_salt = $mysqli->real_escape_string($password_salt);

    $sql = "update users set password_hash = '$password_hash',"
        ." password_salt = '$password_salt', reset_password_key = null,"
        ." reset_password_key_time = null where id_users = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}

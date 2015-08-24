<?php

namespace Users;

function editPassword ($mysqli, $id, $password) {

    include_once __DIR__.'/../Password/hash.php';
    list($password_sha512_hash,
        $password_sha512_key) = \Password\hash($password);

    $password_sha512_hash = $mysqli->real_escape_string($password_sha512_hash);
    $password_sha512_key = $mysqli->real_escape_string($password_sha512_key);

    $sql = 'update users set password_hash = null, password_salt = null,'
        ." password_sha512_hash = '$password_sha512_hash',"
        ." password_sha512_key = '$password_sha512_key',"
        ." reset_password_key = null, reset_password_key_time = null,"
        ." reset_password_return = '' where id_users = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}

<?php

namespace Users;

function resetPassword ($mysqli, $id, $password) {

    include_once __DIR__.'/../Password/hash.php';
    list($password_sha512_hash,
        $password_sha512_key) = \Password\hash($password);

    $password_sha512_hash = $mysqli->real_escape_string($password_sha512_hash);
    $password_sha512_key = $mysqli->real_escape_string($password_sha512_key);

    include_once __DIR__.'/../EncryptionKey/random.php';
    \EncryptionKey\random($password, $encryption_key, $encryption_key_iv);
    $encryption_key = $mysqli->real_escape_string($encryption_key);

    $sql = 'update users set password_hash = null, password_salt = null,'
        ." password_sha512_hash = '$password_sha512_hash',"
        ." password_sha512_key = '$password_sha512_key',"
        ." encryption_key = '$encryption_key',"
        ." encryption_key_iv = $encryption_key_iv,"
        ." reset_password_key = null, reset_password_key_time = null,"
        ." reset_password_return = '' where id_users = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}

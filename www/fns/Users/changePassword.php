<?php

namespace Users;

function changePassword ($mysqli, $user, $currentPassword, $newPassword) {

    $encryption_key = $user->encryption_key;
    $encryption_key_iv = $user->encryption_key_iv;

    include_once __DIR__.'/../EncryptionKey/recreate.php';
    \EncryptionKey\recreate($currentPassword,
        $newPassword, $encryption_key, $encryption_key_iv);

    include_once __DIR__.'/../Password/hash.php';
    list($password_sha512_hash,
        $password_sha512_key) = \Password\hash($newPassword);

    $password_sha512_hash = $mysqli->real_escape_string($password_sha512_hash);
    $password_sha512_key = $mysqli->real_escape_string($password_sha512_key);

    $encryption_key = $mysqli->real_escape_string($encryption_key);
    $encryption_key_iv = $mysqli->real_escape_string($encryption_key_iv);

    $sql = 'update users set password_hash = null, password_salt = null,'
        ." password_sha512_hash = '$password_sha512_hash',"
        ." password_sha512_key = '$password_sha512_key',"
        ." encryption_key = '$encryption_key',"
        ." encryption_key_iv = '$encryption_key_iv'"
        ." where id_users = $user->id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}

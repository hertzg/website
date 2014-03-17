<?php

namespace Users;

function add ($mysqli, $username, $email, $password) {

    include_once __DIR__.'/../Password/hash.php';
    $password_hash = \Password\hash($password);

    $username = $mysqli->real_escape_string($username);
    $email = $mysqli->real_escape_string($email);
    $password = $mysqli->real_escape_string($password_hash);
    $inserttime = time();
    $sql = 'insert into users (username, email, password, inserttime)'
        ." values ('$username', '$email', '$password', $inserttime)";
    $mysqli->query($sql);
    $idusers = $mysqli->insert_id;
    mkdir(__DIR__."/../../users/$idusers");

}

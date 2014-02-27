<?php

namespace Users;

function add ($mysqli, $username, $email, $password) {
    $username = $mysqli->real_escape_string($username);
    $email = $mysqli->real_escape_string($email);
    $password = $mysqli->real_escape_string(md5($password, true));
    $inserttime = time();
    $sql = 'insert into users (username, email, password, inserttime)'
        ." values ('$username', '$email', '$password', $inserttime)";
    $mysqli->query($sql);
    $idusers = $mysqli->insert_id;
    mkdir(__DIR__."/../../users/$idusers");
}

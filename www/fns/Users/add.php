<?php

namespace Users;

function add ($mysqli, $username, $email, $password) {
    $username = mysqli_real_escape_string($mysqli, $username);
    $email = mysqli_real_escape_string($mysqli, $email);
    $password = mysqli_real_escape_string($mysqli, md5($password, true));
    $inserttime = time();
    mysqli_query(
        $mysqli,
        'insert into users (username, email, password, inserttime)'
        ." values ('$username', '$email', '$password', $inserttime)"
    );
    $idusers = mysqli_insert_id($mysqli);
    mkdir(__DIR__."/../../users/$idusers");
}

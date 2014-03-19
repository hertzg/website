<?php

namespace Users;

function getByUsernameAndPassword ($mysqli, $username, $password) {

    include_once __DIR__.'/../Password/hash.php';
    $password_hash = \Password\hash($password);

    $username = $mysqli->real_escape_string($username);
    $password = $mysqli->real_escape_string($password_hash);
    $sql = 'select * from users'
        ." where username = '$username' and password = '$password'";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);

}

<?php

namespace Users;

function getByUsernamePassword ($mysqli, $username, $password) {
    $username = mysqli_real_escape_string($mysqli, $username);
    $password = mysqli_real_escape_string($mysqli, md5($password, true));
    $sql = 'select * from users'
        ." where username = '$username' and password = '$password'";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}

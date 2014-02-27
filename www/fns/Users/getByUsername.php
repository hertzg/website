<?php

namespace Users;

function getByUsername ($mysqli, $username) {
    $username = $mysqli->real_escape_string($username);
    $sql = "select * from users where username = '$username'";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}

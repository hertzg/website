<?php

namespace Users;

function getByUsername ($mysqli, $username, $exclude_id = 0) {
    $username = $mysqli->real_escape_string($username);
    $sql = "select * from users where username = '$username'"
        ." and id_users != $exclude_id";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}

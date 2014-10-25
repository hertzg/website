<?php

namespace Users;

function getByEmail ($mysqli, $email, $exclude_id = 0) {
    $email = $mysqli->real_escape_string($email);
    $sql = 'select * from users'
        ." where email = '$email' and id_users != $exclude_id";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}

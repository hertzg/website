<?php

namespace Users;

function indexByEmail ($mysqli, $email) {
    $email = $mysqli->real_escape_string($email);
    $sql = "select * from users where email = '$email'";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}

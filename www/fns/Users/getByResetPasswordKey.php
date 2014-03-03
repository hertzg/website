<?php

namespace Users;

function getByResetPasswordKey ($mysqli, $idusers, $reset_password_key) {
    include_once __DIR__.'/../hex2bin.php';
    $reset_password_key = $mysqli->real_escape_string(hex2bin($reset_password_key));
    $sql = "select * from users where idusers = $idusers"
        ." and reset_password_key = '$reset_password_key'";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}

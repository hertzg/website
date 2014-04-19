<?php

namespace Users;

function getByResetPasswordKey ($mysqli, $id_users, $reset_password_key) {

    $reset_password_key = hex2bin($reset_password_key);
    $reset_password_key = $mysqli->real_escape_string($reset_password_key);

    $sql = "select * from users where id_users = $id_users"
        ." and reset_password_key = '$reset_password_key'";

    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);

}

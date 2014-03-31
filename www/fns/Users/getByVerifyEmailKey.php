<?php

namespace Users;

function getByVerifyEmailKey ($mysqli, $id_users, $verify_email_key) {
    include_once __DIR__.'/../hex2bin.php';
    $verify_email_key = $mysqli->real_escape_string(hex2bin($verify_email_key));
    $sql = "select * from users where id_users = $id_users"
        ." and verify_email_key = '$verify_email_key'";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}

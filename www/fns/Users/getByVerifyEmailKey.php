<?php

namespace Users;

function getByVerifyEmailKey ($mysqli, $idusers, $verify_email_key) {
    include_once __DIR__.'/../hex2bin.php';
    $verify_email_key = $mysqli->real_escape_string(hex2bin($verify_email_key));
    $sql = 'select * from users'
        ." where idusers = $idusers"
        ." and verify_email_key = '$verify_email_key'";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}

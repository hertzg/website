<?php

namespace Users;

function getByResetPasswordKey ($mysqli, $idusers, $resetpasswordkey) {
    include_once __DIR__.'/../hex2bin.php';
    $resetpasswordkey = $mysqli->real_escape_string(hex2bin($resetpasswordkey));
    $sql = 'select * from users'
        ." where idusers = $idusers"
        ." and resetpasswordkey = '$resetpasswordkey'";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}

<?php

namespace Users;

function editResetPasswordKey ($mysqli, $idusers, $reset_password_key) {
    $reset_password_key = $mysqli->real_escape_string($reset_password_key);
    $reset_password_key_time = time();
    $sql = "update users set reset_password_key = '$reset_password_key',"
        ." reset_password_key_time = $reset_password_key_time"
        ." where idusers = $idusers";
    $mysqli->query($sql) || die($mysqli->error);
}

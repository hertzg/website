<?php

namespace Users;

function editPassword ($mysqli, $idusers, $password) {
    $password = $mysqli->real_escape_string(md5($password, true));
    $sql = "update users set password = '$password',"
        .' reset_password_key = null, reset_password_key_time = null'
        ." where idusers = $idusers";
    $mysqli->query($sql);
}

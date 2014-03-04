<?php

namespace Users;

function login ($mysqli, $idusers) {
    $lastlogintime = time();
    $sql = 'update users set num_logins = num_logins + 1,'
        .' reset_password_key = null, reset_password_key_time = null,'
        ." lastlogintime = $lastlogintime where idusers = $idusers";
    $mysqli->query($sql);
}

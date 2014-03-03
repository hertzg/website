<?php

namespace Users;

function login ($mysqli, $idusers) {
    $lastlogintime = time();
    $sql = 'update users set num_logins = num_logins + 1,'
        ." lastlogintime = $lastlogintime where idusers = $idusers";
    $mysqli->query($sql);
}

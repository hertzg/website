<?php

namespace Users;

function updateLastLoginTime ($mysqli, $idusers) {
    $lastlogintime = time();
    $sql = "update users set lastlogintime = $lastlogintime"
        ." where idusers = $idusers";
    $mysqli->query($sql);
}

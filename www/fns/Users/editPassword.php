<?php

namespace Users;

function editPassword ($mysqli, $idusers, $password) {
    $password = $mysqli->real_escape_string(md5($password, true));
    $sql = 'update users set'
        ." password = '$password',"
        .' resetpasswordkey = null'
        ." where idusers = $idusers";
    $mysqli->query($sql);
}

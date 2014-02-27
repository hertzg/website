<?php

namespace Users;

function editProfile ($mysqli, $idusers, $email, $fullname) {
    $email = $mysqli->real_escape_string($email);
    $fullname = $mysqli->real_escape_string($fullname);
    $sql = 'update users set'
        ." email = '$email',"
        ." fullname = '$fullname'"
        ." where idusers = $idusers";
    $mysqli->query($sql);
}

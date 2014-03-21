<?php

namespace Users;

function editProfile ($mysqli, $idusers, $email, $full_name) {
    $email = $mysqli->real_escape_string($email);
    $full_name = $mysqli->real_escape_string($full_name);
    $sql = 'update users set'
        ." email = '$email',"
        ." full_name = '$full_name'"
        ." where idusers = $idusers";
    $mysqli->query($sql);
}

<?php

namespace Users;

function editProfile ($mysqli, $id_users,
    $username, $email, $full_name, $timezone, $disabled) {

    $username = $mysqli->real_escape_string($username);
    $email = $mysqli->real_escape_string($email);
    $full_name = $mysqli->real_escape_string($full_name);
    $disabled = $disabled ? '1' : '0';

    $sql = "update users set username = '$username', email = '$email',"
        ." full_name = '$full_name', timezone = $timezone,"
        ." disabled = $disabled where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}

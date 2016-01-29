<?php

namespace Users;

function editProfile ($mysqli, $id_users, $username,
    $email, $full_name, $timezone, $admin, $disabled, $expires) {

    $username = $mysqli->real_escape_string($username);
    $lowercase_username = $mysqli->real_escape_string(strtolower($username));
    $email = $mysqli->real_escape_string($email);
    $full_name = $mysqli->real_escape_string($full_name);
    $admin = $admin ? '1' : '0';
    $disabled = $disabled ? '1' : '0';
    $expires = $expires ? '1' : '0';

    $sql = "update users set username = '$username',"
        ." lowercase_username = '$lowercase_username',"
        ." email = '$email', full_name = '$full_name',"
        ." timezone = $timezone, admin = $admin, disabled = $disabled,"
        ." expires = $expires where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}

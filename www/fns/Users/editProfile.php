<?php

namespace Users;

function editProfile ($mysqli, $id_users, $email, $full_name) {
    $email = $mysqli->real_escape_string($email);
    $full_name = $mysqli->real_escape_string($full_name);
    $sql = "update users set email = '$email',"
        ." full_name = '$full_name' where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

<?php

namespace Users;

function editResetPasswordKey ($mysqli, $id_users, $reset_password_key) {
    $reset_password_key = $mysqli->real_escape_string($reset_password_key);
    $reset_password_key_time = time();
    $sql = "update users set reset_password_key = '$reset_password_key',"
        ." reset_password_key_time = $reset_password_key_time"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

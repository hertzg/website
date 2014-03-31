<?php

namespace Users;

function login ($mysqli, $id_users) {
    $last_login_time = time();
    $sql = 'update users set num_logins = num_logins + 1,'
        .' reset_password_key = null, reset_password_key_time = null,'
        ." last_login_time = $last_login_time where id_users = $id_users";
    $mysqli->query($sql);
}

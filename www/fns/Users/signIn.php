<?php

namespace Users;

function signIn ($mysqli, $id_users) {
    $last_signin_time = time();
    $sql = 'update users set num_signins = num_signins + 1,'
        ." email_expire_time = null, last_signin_time = $last_signin_time"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

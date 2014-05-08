<?php

namespace Users;

function editVerifyEmailKey ($mysqli, $id_users, $verify_email_key) {
    $verify_email_key = $mysqli->real_escape_string($verify_email_key);
    $verify_email_key_time = time();
    $sql = "update users set verify_email_key = '$verify_email_key',"
        ." verify_email_key_time = '$verify_email_key_time'"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

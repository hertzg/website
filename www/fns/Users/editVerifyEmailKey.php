<?php

namespace Users;

function editVerifyEmailKey ($mysqli, $idusers, $verify_email_key) {
    $verify_email_key = $mysqli->real_escape_string($verify_email_key);
    $verify_email_key_time = time();
    $sql = "update users set verify_email_key = '$verify_email_key',"
        ." verify_email_key_time = '$verify_email_key_time'"
        ." where idusers = $idusers";
    $mysqli->query($sql);
}

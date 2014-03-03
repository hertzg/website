<?php

namespace Users;

function editVerifyEmailKey ($mysqli, $idusers, $verify_email_key) {
    $verify_email_key = $mysqli->real_escape_string($verify_email_key);
    $sql = "update users set verify_email_key = '$verify_email_key'"
        ." where idusers = $idusers";
    $mysqli->query($sql);
}

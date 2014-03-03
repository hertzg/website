<?php

namespace Users;

function verifyEmail ($mysqli, $idusers) {
    $sql = 'update users set verify_email_key = null, email_verified = 1,'
        ." verify_email_key_time = null where idusers = $idusers";
    $mysqli->query($sql);
}

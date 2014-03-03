<?php

namespace Users;

function verifyEmail ($mysqli, $idusers) {
    $sql = 'update users set email_verified = 1, verify_email_key = null'
        ." where idusers = $idusers";
    $mysqli->query($sql);
}

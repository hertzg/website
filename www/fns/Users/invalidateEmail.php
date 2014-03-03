<?php

namespace Users;

function invalidateEmail ($mysqli, $idusers) {
    $sql = 'update users set verify_email_key = null, email_verified = 0'
        ." where idusers = $idusers";
    $mysqli->query($sql);
}
